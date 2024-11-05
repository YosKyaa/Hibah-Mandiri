<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

use App\Models\MainResearchTarget;
// use App\Models\Proposal;
use App\Models\ResearchCategories;
use App\Models\TktTypes;
use App\Models\User;
// use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;


class HeadOfLPPMController extends Controller
{
    public function index()
    {
        $recommended = Proposal::where('is_recommended', true)->count();
        $notRecommended = Proposal::where('is_recommended', false)->count();
        $totalProposal = Proposal::whereNotNull('is_recommended')->count();
        $researchcategories = ResearchCategories::all();
        $tktTypes = TktTypes::all();
        $mainresearchtargets = MainResearchTarget::all();
        return view('headoflppm.index', compact('recommended', 'notRecommended', 'totalProposal', 'researchcategories', 'tktTypes', 'mainresearchtargets'));
    }


    public function data(Request $request)
    {
        // $this->authorize('setting/manage_data/department.read');
        $data = Proposal::with([
            'users' => function ($query) {
                $query->select('id', 'name', 'username', 'image');
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
                $query->select('id', 'username','name', 'image');
            },
            'documents' => function ($query) {
                $query->select('id', 'proposals_id', 'proposal_doc', 'doc_type_id', 'created_by');
            },
        ])
            ->select('*')
            ->whereNotNull('is_recommended')
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

    // Detail Proposal
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

        return view('headoflppm.show', compact('proposals', 'documentUrl', 'user'));
    }
    public function download($id)
    {
        $proposal = Proposal::findOrFail($id);
        $document = $proposal->documents()->where('doc_type_id', 'DC2')->firstOrFail();
        $documentPath = $document->proposal_doc;
        return response()->file(public_path($documentPath));
    }

    public function revision($id)
    {
        $proposal = Proposal::findOrFail($id);
        $documentPath = $proposal->documents->first()->proposal_doc;
        $documentUrl = url($documentPath);
        return view('headoflppm.revision', compact('proposal', 'documentUrl'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'review_notes' => ['required', 'string'],
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'review_notes' => $request->review_notes,
            'status_id' => 'S04',
        ]);

        return redirect()->route('headoflppm.proposals.index')->with('success', 'Catatan revisi berhasil disimpan.');
    }



    public function approve(Request $request)
    {
        $data = Proposal::find($request->id);
        if ($data) {
            $data->approval_head_of_lppm = true;
            $data->status_id = 'S06';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status!'
            ]);
        }
    }


    public function reject($id)
    {
        $proposal = Proposal::findOrFail($id);
        $documentPath = $proposal->documents->first()->proposal_doc;
        $documentUrl = url($documentPath);
        return view('headoflppm.reject', compact('proposal', 'documentUrl'));
    }

    public function rejectUpdate(Request $request, $id)
    {
        $request->validate([
            'reject_notes' => ['required', 'string'],
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'reject_notes' => $request->reject_notes,
            'status_id' => 'S05',
        ]);

        return redirect()->route('headoflppm.proposals.index')->with('success', 'Proposal berhasil ditolak.');
    }


    public function disapprove(Request $request)
    {
        $data = Proposal::find($request->id);
        if ($data) {
            $data->approval_head_of_lppm = false;
            $data->status_id = 'S05';
            $data->save();
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status!'
            ]);
        }
    }


}
