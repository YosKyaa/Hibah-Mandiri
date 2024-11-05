<?php

namespace App\Http\Controllers;

use App\Mail\LOA;
use App\Models\Documents;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Mail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

use DB;
use Illuminate\Support\Facades\File;


class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status1 = 'S02';
        $status2 = ['S05', 'S06', 'S07', 'S08', 'S09', 'S10'];
        $dataCount = Proposal::where('status_id', $status1)->count();
        $dataCount2 = Proposal::where('status_id', $status2)->count();
        $totalData = Proposal::where('reviewer_id', auth()->user()->id)->count();
        return view('reviewers.index', compact('dataCount', 'dataCount2', 'totalData'));
    }

    public function data(Request $request)
    {
        $reviewerId = $request->user()->id;
        $data = Proposal::where('reviewer_id', $reviewerId)
            ->with([
                'users' => function ($query) {
                    $query->select('id', 'name');
                },
                'statuses' => function ($query) {
                    $query->select('id', 'status', 'color');
                },
                'reviewer' => function ($query) {
                    $query->select('id', 'name');
                },
                'proposalTeams.researcher' => function ($query) {
                    $query->select('id', 'name', 'image');
                },
                'documents' => function ($query) {
                    $query->select('id', 'proposals_id', 'proposal_doc', 'doc_type_id', 'created_by');
                },
            ])
            ->orderBy('id')
            ->get();

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
        return view('reviewers.show', compact('proposals', 'documentUrl', 'user'));
    }

    // Lolos Proposal
    public function approval_reviewer(Request $request)
    {
        $data = Proposal::with([
            'users' => function ($query) {
                $query->select('id', 'email');
            }
        ])->find($request->id);
        // dd($data);
        if ($data) {
            $data->approval_reviewer = true;
            $x = $data->save();
            if ($x) {
                //kirim email
                Mail::to($data->users->email)->send(new LOA('emails.approval', "Proposal Anda Lolos"));
            }
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

    // Proposal Ditolak
    public function reject(Request $request)
    {
        $data = Proposal::with([
            'users' => function ($query) {
                $query->select('id', 'email');
            }
        ])->find($request->id);
        // dd($data);
        if ($data) {
            $data->status_id = 'S04';
            $x = $data->save();
            if ($x) {
                //kirim email
                Mail::to($data->users->email)->send(new LOA('emails.rejection', "Proposal di tolak"));
            }
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


    public function revision($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('reviewers.revision', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'review_notes' => ['required', 'string'],
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'review_notes' => $request->review_notes,
            'status_id' => 'S03',
        ]);

        return redirect()->route('reviewers.index')->with('success', 'Catatan revisi berhasil disimpan.');
    }


    public function last_revision($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('reviewers.last-revision', compact('proposal'));
    }
    public function update2(Request $request, $id)
    {
        $request->validate([
            'review_notes_2' => ['required', 'string'],
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'review_notes_2' => $request->review_notes_2,
            'status_id' => 'S03',
        ]);

        return redirect()->route('reviewers.index')->with('success', 'Catatan revisi berhasil disimpan.');
    }


    public function presentation(Request $request)
    {
        $data = Proposal::find($request->id);
        if ($data) {
            $data->status_id = 'S05'; // Set the status to 'S05'
            $data->save(); // Save the changes to the database
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


    public function mark_as_presented(Request $request)
    {
        $data = Proposal::find($request->id);
        if ($data) {
            $data->mark_as_presented = true;
            $data->status_id = 'S07';
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

    public function print_pdf($id)
    {
        $proposals = Proposal::findOrFail($id);

        $pdf = PDF::loadView('proposals.print', compact('proposals'));
        return $pdf->stream('proposal.pdf');
    }
    public function print_loa($id)
    {
        $proposals = Proposal::findOrFail($id);
        $pdf = PDF::loadView('proposals.print_loa', compact('proposals'));
        return $pdf->stream('proposal.pdf');
    }

    public function assessment($id)
    {
        $proposals = Proposal::with('documents')->findOrFail($id);
        $documentPath = $proposals->documents->first()->proposal_doc;
        $documentUrl = url($documentPath);

        // Path dan URL untuk file PDF `form_review_hibah.pdf`
        $pdfFilePath = url('storage/formtemplate/form_review_hibah.pdf');
        return view('reviewers.assessment', compact('proposals', 'documentUrl','pdfFilePath'));
    }


    public function assessment_update(Request $request, $id)
    {
        $request->validate([
            'proposal_doc' => 'required|file|mimes:pdf|max:5120',
            'is_recommended' => 'required|boolean',
        ]);

        if (!$request->hasFile('proposal_doc')) {
            return redirect()->back()->with('errror', 'Proposal document is required.');
        }

        try {
            $fileName = "";
            if ($request->hasFile('proposal_doc')) {
                $ext = $request->proposal_doc->extension();
                $name = str_replace(' ', '_', $request->proposal_doc->getClientOriginalName());
                $fileName = Auth::user()->id . '_' . $name;
                $folderName = "storage/FILE/assessment/" . Carbon::now()->format('Y/m');
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
                'status_id' => 'S02',
                'is_recommended' => $request->is_recommended,
            ]);

            Documents::create([
                'proposals_id' => $proposals->id,
                'proposal_doc' => $fileName,
                'doc_type_id' => 'DC2',
                'created_by' => Auth::user()->id,
            ]);

            return redirect()->route('reviewers.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('reviewers.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
