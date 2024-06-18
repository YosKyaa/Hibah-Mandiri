<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AddReviewerController extends Controller
{
    public function index()
    {
        $proposalApproved = Proposal::where('approval_reviewer', true)->count();
        $proposalDisapprove = Proposal::where('status_id', '=', "S04")->count();
        $proposalCount = Proposal::count();
        $lecturers = User::role('lecture')->get();
        $reviewers = User::role('reviewer')->get();
        $totalUsers = $lecturers->concat($reviewers)->count();
        return view('admin.addreviewer.index', compact( 'totalUsers', 'proposalCount', 'proposalApproved', 'proposalDisapprove'));
    }


    /**
     * Show the form for creating a new resource.
     */

     public function data(Request $request) {
        // $this->authorize('setting/manage_data/department.read');
        $data = Proposal::with([
            'users' => function ($query) {
                $query->select('id', 'username');
            },
            'statuses' => function ($query) {
                $query->select('id', 'status', 'color');
            },
            'reviewer' => function ($query) {
                $query->select('id', 'username');
            },
            'proposalTeams.researcher' => function ($query) {
                $query->select('id', 'username');
            },
            'documents' => function ($query) {
                $query->select('id', 'proposals_id','proposal_doc', 'doc_type_id', 'created_by');
            },
        ])
        ->select('*')
        ->whereHas('statuses', function ($query) {
            $query->where('id', 'S01',)
            ->orWhere('id', 'S02');
        })
        ->orderBy('id');
        return DataTables::of($data)
        ->filter(function ($query) use ($request) {
            if (!empty($request->get('search'))) {
                $search = $request->get('search');
                $query->where('research_title', 'LIKE', "%$search%")
                    ->orWhereHas('users', function ($query) use ($search) {
                        $query->where('username', 'LIKE', "%$search%");
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

    public function edit($id)
    {
        $proposals = Proposal::findOrFail($id);
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecture', 'reviewer');
        })->get();

        return view('admin.addreviewer.edit', compact('proposals', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'review_date_start' => ['date', 'required'],
            'review_date_end' => ['date', 'required'],
            'reviewer_id' => 'required|exists:users,id',
        ]);

        $proposals = Proposal::findOrFail($id);

        // Validasi bahwa proposal tidak akan diassign ke reviewer yang sama lebih dari dua kali
        $assignedCount = Proposal::where('reviewer_id', $request->reviewer_id)->count();
        if ($assignedCount >= 3) {
            return redirect()->back()->with('error', 'Reviewer telah melebihi batas penerimaan proposal.');
        }

        $proposals->update([
            'review_date_start' => $request->review_date_start,
            'review_date_end' => $request->review_date_end,
            'reviewer_id' => $request->reviewer_id,
            'status_id' => 'S02'
        ]);

        // Assign reviewer role
        $reviewer = User::findOrFail($request->reviewer_id);
        $reviewer->assignRole('reviewer');

        return redirect()->route('addreviewer.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function edit_add($id)
    {
        $users = User::all();
        $proposals = Proposal::findOrFail($id);
        return view('admin.addreviewer.edit', compact('proposals','users'));
    }
    public function update_add(Request $request, $id)
    {
        $request->validate([
            'review_date_start' => ['date','required'],
            'review_date_end' => ['date','required'],
            'reviewer_id' => 'required|exists:users,id',
        ]);

        $proposals = Proposal::findOrFail($id);
        $proposals->update([
            'review_date_start' => $request->review_date_start,
            'review_date_end' => $request->review_date_end,
            'reviewer_id' => $request->reviewer_id,
        ]);

        // Assign reviewer role
        $reviewer = User::findOrFail($request->reviewer_id);
        $reviewer->assignRole('reviewer');

        return redirect()->route('addreviewer.index')->with('Data,', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request){
        $data = Proposal::find($request->id);
        if($data){
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil dihapus!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal dihapus!'
            ]);
        }
    }
}
