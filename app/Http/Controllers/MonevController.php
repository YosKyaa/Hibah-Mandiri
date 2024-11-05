<?php

namespace App\Http\Controllers;

use App\Models\MainResearchTarget;
use App\Models\Proposal;
use App\Models\ResearchCategories;
use App\Models\TktTypes;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\LOA;
use App\Models\Documents;
use Mail;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Auth;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MonevController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recommended = Proposal::where('is_recommended', true)->count();
        $notRecommended = Proposal::where('is_recommended', false)->count();
        $totalProposal = Proposal::whereHas('documents', function ($query) {
            $query->where('doc_type_id', 'DC5');
        })->count();
        $researchcategories = ResearchCategories::all();
        $tktTypes = TktTypes::all();
        $mainresearchtargets = MainResearchTarget::all();
        return view('headoflppm.monev.index', compact('recommended', 'notRecommended', 'totalProposal', 'researchcategories', 'tktTypes', 'mainresearchtargets'));
    }

    public function data(Request $request)
    {
        $data = Proposal::with([
                'users' => function ($query) {
                    $query->select('id', 'name');
                },
                'researchType' => function ($query) {
                    $query->select('id', 'title');
                },
                'researchTopic' => function ($query) {
                    $query->select('id', 'name');
                },
                'documents' => function ($query) {
                    $query->select('id', 'proposals_id', 'proposal_doc', 'doc_type_id', 'created_by');
                },
                'statuses' => function ($query) {
                    $query->select('id', 'status', 'color');
                },
            ])
            ->select('*')
            ->whereHas('documents', function ($query) {
                $query->where('doc_type_id', 'DC5');
            })
            ->orderBy('id');

        return DataTables::of($data)
            ->filter(function ($instance) use ($request) {
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

    public function print_monev($id)
    {
        $proposal = Proposal::findOrFail($id);
        $documentPath = $proposal->documents->where('doc_type_id', 'DC5')->first()->proposal_doc;
        $documentUrl = url($documentPath);
        return redirect()->away($documentUrl);
    }

    public function approve(Request $request)
    {
        $data = Proposal::find($request->id);
        if ($data) {
            $data->mark_as_verif_monev = true;
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

    public function review($id)
    {
        $proposals = Proposal::findOrFail($id);
        $documentPath = $proposals->documents->where('doc_type_id', 'DC5')->first()->proposal_doc;
        $documentUrl = url($documentPath);
        return view('headoflppm.monev.review', compact('proposals', 'documentUrl', 'documentPath'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'proposal_doc' => 'required|file|mimes:pdf|max:5120',
            'notes' => 'required|string',
        ]);

        if (!$request->hasFile('proposal_doc')) {
            return redirect()->back()->with('error', 'Proposal document is required.');
        }

        try {
            $fileName = "";
            if ($request->hasFile('proposal_doc')) {
                $ext = $request->proposal_doc->extension();
                $name = str_replace(' ', '_', $request->proposal_doc->getClientOriginalName());
                $fileName = Auth::user()->id . '_' . $name;
                $folderName = "storage/FILE/monev_review/" . Carbon::now()->format('Y/m');
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
                'status_id' => 'S08',
                'notes' => $request->notes,
            ]);

            Documents::create([
                'proposals_id' => $proposals->id,
                'proposal_doc' => $fileName,
                'doc_type_id' => 'DC7',
                'created_by' => Auth::user()->id,
            ]);

            return redirect()->route('monev.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('monev.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}

