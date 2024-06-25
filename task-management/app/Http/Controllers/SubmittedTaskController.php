<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubmittedTask;
use App\Models\User;

class SubmittedTaskController extends Controller
{
    //

    public function submitTask (Request $request, $taskid,$userId){

        $request->validate([
            'task_Name' => 'required|string',
            'submited_task_description' => 'required|string',
            'submited_task_file' => 'required|file',
        ]);

        $task = new SubmittedTask();
        $task->user_id = $userId;
        $task->assigned_task_id = $taskid;
        $task->title = $request->task_Name;
        $task->description = $request->submited_task_description;


        if ($request->hasFile('submited_task_file')) {
            $task->file_uri = $request->file('submited_task_file')->store('submited_task_file', 'public');

        }
        $task->save();
        return redirect()->back()->with('success', 'Task submitted successfully');


    }

    public function mySubmition (Request $request,$taskId,$userId){
        $user = User::find($userId);

        $SubmitedTask = SubmittedTask::where('user_id', $userId)
        ->where('assigned_task_id',$taskId)
        ->latest()
        ->get(); 

        return view('Dashbord.mySubmition',['SubmitedTask'=>$SubmitedTask,'user'=>$user]);
    }


    public function SubmitedTask($taskId,$userId,$managerId){
        $manager = User::findOrFail($managerId);
        $user = User::findOrFail($userId);
        $SubmitedTask = SubmittedTask::where('user_id', $userId)
        ->where('assigned_task_id',$taskId)
        ->latest()
        ->get();
        

        return view('Dashbord.SubmitedTask',['SubmitedTask'=>$SubmitedTask,'manager'=>$manager,'user'=>$user]);


    }

    public function feadback(Request $request,$submitId){
        

        $request->validate([
            'comment' => 'required|string',
            'progress' => 'required|integer', 
        ]);
        

        $submittedTask = SubmittedTask::findOrFail($submitId);
        $submittedTask->comment = $request->comment; 
        $submittedTask->progress = $request->progress; 

        $submittedTask->save();

        return redirect()->back()->with('success', 'You are successfully commented');

    }
}
