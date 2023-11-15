<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\AnalysisStatus;
use App\Models\Phase;
use App\Models\Reason;
use App\Models\Respon;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeveloperController extends Controller
{
    public function taskdev()
    {
        $listanalysis = Analysis::all();



        // $getstatus = $analysisStatus->analysis;

        // dd($analysisStatus);

        // $phase = Phase::with('analysis')->get();

        // dd($project);

        // $user = $listanalysis->user;

        // $convertTime = Carbon::createFromFormat('H:i:s', $listanalysis->timeline)->format('h:i A');

        
        // dd($convertTime);
        return view('taskdev',compact('listanalysis'));
    }

    public function acceptTask($id)
    {

        $analysisid = Analysis::find($id);

        // dd($analysisid->id);

        $create2 = Analysis::where('id', $analysisid->id)->update(['status_id' => 2]);

        if ($create2) {
            return redirect()->back()->with('success', 'Task accepted');
        } else {
            return redirect()->back()->with('error', 'Task not found');
        }
    }


    public function rejectTask(Request $request,$id) 
    {
            $request->validate([
                'justification' => 'required',
                'item_id' => 'required', // Ensure the item_id exists in the analyses table
            ]);

            
            $create2 = Reason::create([
                'analysis_id' => $request->item_id,
                'user_id' => $id,
                'issue' => $request->justification
            ]);

            $create3 = Analysis::where('id', $request->item_id)->update([
                    'status_id' => 4]);


        // $create2 = Analysis::where('id', $request->item_id)->update([
        //     'justification' => $request->justification,
        //     'status_id' => 4]);

            if ($create2) {
                return redirect()->back()->with('success', 'Task rejected');
            } else {
                return redirect()->back()->with('error', 'Task not found');
            }

    }

    public function viewAnalyst($id) 
    {
    
        $analysis = Analysis::find($id);

        if($analysis->reason)
        {
            $reason = $analysis->reason->id;
            $respon = Respon::where('reason_id', $reason)->get();
            return view('view-analyst',compact('analysis','respon'));
        }
        else{
            return view('view-analyst',compact('analysis'));
        }

    }

      

    
}
