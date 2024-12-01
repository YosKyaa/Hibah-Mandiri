<?php

namespace App\Http\Controllers;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Documents;
use PDF;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class FundDisbursement2Controller extends Controller
{
    public function index()
    {
        $proposalApproved = Proposal::where('approval_head_of_lppm', true)->count();
        $proposalDisapprove = Proposal::where('approval_head_of_lppm', false)->count();
        $proposalCount = Proposal::count();
        $lecturers = User::role('lecture')->get();
        $reviewers = User::role('reviewer')->get();
        $totalUsers = $lecturers->concat($reviewers)->count();
        $totalNullReviewers = Proposal::whereNull('reviewer_id')->count();
        return view('admin.fund-disbursement-2.index', compact( 'totalUsers', 'proposalCount', 'totalNullReviewers', 'proposalApproved', 'proposalDisapprove'));
    }
    public function data(Request $request) {
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
            'proposalTeams.researcher' => function ($query) {
                $query->select('id', 'username');
            },
            'documents' => function ($query) {
                $query->select('id', 'proposals_id','proposal_doc', 'doc_type_id', 'created_by');
            },
        ])
        ->select('*')
        ->whereHas('statuses', function ($query) {
            $query->where('id', 'S08',)
            ->orWhere('id', 'S10');
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
    public function transfer_receipt($id)
    {
        try {
            $proposals = Proposal::findOrFail($id);
        $documentPath = $proposals->documents->where('doc_type_id', 'DC6')->first()->proposal_doc;
        $documentUrl = url($documentPath);
            return view('admin.fund-disbursement-2.transfer_receipt', compact('proposals', 'documentUrl', 'documentPath'));
        } catch (\Exception $e) {
            return redirect()->route('fund-disbursement-2.index')->with('error', 'Failed to generate transfer receipt: ' . $e->getMessage());
        }
    }
    public function transfer_receipt_update(Request $request, $id)
    {
        try {
            $request->validate([
                'proposal_doc' => 'required|file|mimes:png,jpg,pdf|max:5120',
            ]);

            $fileName = "";
            if ($request->hasFile('proposal_doc')) {
                $ext = $request->proposal_doc->extension();
                $name = str_replace(' ', '_', $request->proposal_doc->getClientOriginalName());
                $fileName = Auth::user()->id . '_' . $name;
                $folderName = "storage/FILE/receipt_1/" . Carbon::now()->format('Y/m');
                $path = public_path() . "/" . $folderName;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true); //create folder
                }
                $upload = $request->proposal_doc->move($path, $fileName); //upload file to folder
                if ($upload) {
                    $fileName = $folderName . "/" . $fileName;
                } else {
                    $fileName = "";
                }
            }

            $proposals = Proposal::findOrFail($id);
            $proposals->update([
                'status_id' => 'S10',
            ]);
            Documents::create([
                'proposals_id' => $proposals->id,
                'proposal_doc' => $fileName,
                'doc_type_id' => 'DC4',
                'created_by' => Auth::user()->id,
            ]);

            return redirect()->route('fund-disbursement-2.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('fund-disbursement-2.index')->with('error', 'Failed to update transfer receipt: ' . $e->getMessage());
        }
    }
}
