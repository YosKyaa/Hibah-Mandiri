<?php

namespace App\Http\Controllers;

use App\Models\MainResearchTarget;
use App\Models\Proposal;
use App\Models\ResearchCategories;
use App\Models\TktTypes;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposalApproved = Proposal::where('approval_head_of_lppm', true)->count();
        $proposalDisapprove = Proposal::where('approval_head_of_lppm', false)->count();
        $proposalCount = Proposal::where('status_id', '!=', 'S00')->count();
        $lecturers = User::role('lecture')->get();
        $reviewers = User::role('reviewer')->get();
        $totalUsers = $lecturers->concat($reviewers)->count();
        $researchcategories = ResearchCategories::all();
        $tktTypes = TktTypes::all();
        $mainresearchtargets = MainResearchTarget::all();
        return view('admin.index', compact( 'totalUsers', 'proposalCount', 'proposalApproved', 'proposalDisapprove', 'researchcategories', 'tktTypes', 'mainresearchtargets'));
    }

    public function show($id)
    {
        $proposals = Proposal::with([
            'proposalTeams.researcher' => function ($query) {
            $query->select('id', 'username', 'image');
            },
            'reviewer' => function ($query) {
                $query->select('id', 'username', 'image');
            },
        ])->findOrFail($id);
        $documentPath = $proposals->documents->first()->proposal_doc;
        $documentUrl = url($documentPath);
        $user = User::select('image');
        return view('admin.show', compact('proposals', 'documentUrl', 'user'));
    }
    /**
     * Show the form for creating a new resource.
     */

    public function data(Request $request)
    {
        // $this->authorize('setting/manage_data/department.read');
        $data = Proposal::with([
            'users' => function ($query) {
                $query->select('id', 'name');
            },
            'statuses' => function ($query) {
                $query->select('id', 'status', 'color');
            },
            'reviewer' => function ($query) {
                $query->select('id', 'username');
            },
            'researchTopic.researchTheme.researchCategory' => function ($query) {
                $query->select('id', 'name');
            },
            'tktType' => function ($query) {
                $query->select('id', 'title');
            },
            'mainResearchTarget' => function ($query) {
                $query->select('id', 'title');
            },
            'proposalTeams.researcher' => function ($query) {
                $query->select('id', 'username', 'image', 'email', 'name');
            },
            'documents' => function ($query) {
                $query->select('id', 'proposals_id', 'proposal_doc', 'doc_type_id', 'created_by');
            },
        ])
            ->select('*')
            ->where('status_id', '!=', 'S00')
            ->orderBy('id');

        return DataTables::of($data)
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('select_category'))) {
                    $instance->whereHas('researchTopic.researchTheme.researchCategory', function ($query) use ($request) {
                        $query->where('id', $request->get('select_category'));
                    });
                }

                if (!empty($request->get('select_tkt_type'))) {
                    $instance->whereHas('tktType', function ($query) use ($request) {
                        $query->where('tkt_types_id', $request->get('select_tkt_type'));
                    });
                }
                if (!empty($request->get('select_main_research_target'))) {
                    $instance->whereHas('mainResearchTarget', function ($query) use ($request) {
                        $query->where('main_research_targets_id', $request->get('select_main_research_target'));
                    });
                }
            if (!empty($request->get('search'))) {
                $search = $request->get('search');
                $instance->where(function ($query) use ($search) {
                $query->where('research_title', 'LIKE', "%$search%")
                    ->orWhereHas('users', function ($query) use ($search) {
                    $query->where('username', 'LIKE', "%$search%");
                    });
                });
            }
            })
            ->make(true);
    }
    public function datatables()
    {
        $proposals = Proposal::select('*');
        return DataTables::of($proposals)->make(true);
    }


}
