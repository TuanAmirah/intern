<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\AnalysisStatus;
use App\Models\File;
use App\Models\FileTemp;
use App\Models\Phase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnalysisController extends Controller
{
    public function createanalyst()
    {
        $phases = Phase::all();
        $projects = Project::all();

        $user = User::find(Auth::user()->id);

        $image = $user->image;

        $referenceNumber = 'R' . date('Ymd') . mt_rand(1000, 9999);

        return view('create-analyst', compact('phases', 'projects', 'image', 'referenceNumber'));
    }

    public function viewFile()
    {


        // $filePath = public_path('storage/' . $filename);

        // if (file_exists($filePath)) {
        //     return response()->file($filePath);
        // } else {
        //     // Handle the case where the file doesn't exist
        //     return response('File not found', 404);
        // }
    }

    public function submitanalyst(Request $request, $id)
    {
        $create = Analysis::create([
            'user_id' => $id,
            'project_id' => $request->project,
            'phase_id' => $request->phase,
            'notes' => $request->notes,
            'deadline' => $request->deadline,
            'timeline' => $request->timeline,
        ]);

        if (!$create) {
            return redirect()
                ->back()
                ->with('Error', 'Update analyst unsuccesfully');
        }

        $ref = $request->referenceNumber;

        $fileInfo = FileTemp::where('ref_no', $ref)->get(['file_name', 'file_type', 'file_size', 'file_path']);

        foreach ($fileInfo as $file) {
            $fileName = $file->file_name;
            $fileType = $file->file_type;
            $fileSize = $file->file_size;
            $filePath = $file->file_path;

            $create2 = File::create([
                'analysis_id' => $create->id,
                'ref_no' => $ref,
                'file_name' => $fileName,
                'file_type' => $fileType,
                'file_size' => $fileSize,
                'file_path' => $filePath,
            ]);

            if (!$create2) {
                // $success = false; // Set the flag to indicate an error
                break; // Exit the loop early if an error occurs
            }
        }
        if (!$create2) {
            return redirect()
                ->back()
                ->with('Error', 'Update analyst unsuccesfully');
        } else {
            return redirect()
                ->route('create.analyst')
                ->with('success', 'success update');
        }
    }

    public function uploadFileTemp(Request $request)
    {
        try {
            $file = $request->file('file');

            $ref = $request->input('referenceNumber');

            if (!$file) {
                return response()->json(['error' => 'No file uploaded'], 400);
            }

            $filename = $file->getClientOriginalName();
            $filetype = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
            $file->storeAs('public/file_pdf', $ref . '_' . $filename);

            $pathfile = 'file_pdf/' . $ref . '_' . $filename;
            $create = FileTemp::create([
                'ref_no' => $ref,
                'file_name' => $filename,
                'file_type' => $filetype,
                'file_size' => $filesize,
                'file_path' => $pathfile,
            ]);
            if (!$create) {
                return response()->json(['message' => 'Fail inserted to database'], 200);
            }

            return response()->json(['message' => 'File uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeFile(Request $request)
    {
        $filename = $request->input('filename');

        $ref = $request->input('referenceNumber');

        $getfile = $ref . '_' . $filename;

        try {
            // Check if the file exists in the storage directory
            if (Storage::exists('public/file_pdf/' . $getfile)) {
                // Delete the file from the storage directory
                Storage::delete('public/file_pdf/' . $getfile);

                // Delete the file in database
                FileTemp::where('file_path', 'file_pdf/' . $getfile)->delete();

                return response()->json(['message' => 'File deleted successfully'], 200);
            } else {
                return response()->json(['error' => 'File not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function listAnalyst()
    {
        $listanalysis = Analysis::all();
        return view('list-analyst', compact('listanalysis'));
    }

    public function deleteAnalyst(Request $request) 
    {
            $request->validate([
                'item_id' => 'required', // Ensure the item_id exists in the analyses table
            ]);

            // $refNo = File::where('analysis_id', $request->item_id)->value('ref_no');

            // $analysisid = File::where('analysis_id',$request->item_id);

           try{
                $refNo = File::where('analysis_id', $request->item_id)->value('ref_no');

                $filename = File::where('analysis_id', $request->item_id)->value('file_name');


                $getfile = $refNo . '_' . $filename;

                foreach($refNo as $ref)
                {
                    if (Storage::exists('public/file_pdf/' . $getfile)) {
                        // Delete the file from the storage directory
                        Storage::delete('public/file_pdf/' . $getfile);
                        // Delete the file in database
                        FileTemp::where('file_path', 'file_pdf/' . $getfile)->delete();
    
                        Analysis::where('id', $request->item_id)->delete();
    
                        return redirect()->back()->with('success', 'Analyst deleted');
        
                    } else {
                        Analysis::where('id', $request->item_id)->delete();
                        return response()->json(['error' => 'File not found'], 404);
                    }

                }

                

               

               
           }
           catch (\Exception $e) 
           {
            return response()->json(['error' => $e->getMessage()], 500);
            }

    }

    
}
