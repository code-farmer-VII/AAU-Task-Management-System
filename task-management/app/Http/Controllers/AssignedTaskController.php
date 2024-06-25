<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AssignedTask;
use Illuminate\Http\Request;
use App\Models\SubmittedTask;

class AssignedTaskController extends Controller
{
    //

    public function assignTask(Request $request, $userId)
    {

        
        $request->validate([
            'task_Name' => 'required|string',
            'task_description' => 'required|string',
        ]);
         
        $assignedTask = new AssignedTask();
        $assignedTask->user_id = $userId;
        $assignedTask->title = $request->task_Name;
        $assignedTask->description = $request->task_description;



        if ($request->hasFile('task_file')) {
            $assignedTask->file_uri = $request->file('task_file')->store('task_files', 'public');
        }
        
        $assignedTask->save();

        return redirect()->back()->with('success', 'Task assigned successfully');

    }

    public function showAssignedTasks(Request $request, $userId, $managerId) {
        $user = User::findOrFail($userId);
        $manager = User::findOrFail($managerId);
        $assignedTasks = AssignedTask::where('user_id', $userId)->latest()->get();
        
        $progress = [];
        foreach ($assignedTasks as $task) {
            $latestSubmittedTask = SubmittedTask::where('user_id', $userId)
                ->where('assigned_task_id', $task->id)
                ->latest()
                ->pluck('progress')
                ->first();
    
            $progress[$task->id] = $latestSubmittedTask;
        }
    
        return view('Dashbord.AssignedTask', [
            'assignedTasks' => $assignedTasks,
            'user' => $user,
            'manager' => $manager,
            'progress' => $progress
        ]);
    }
    

     public function myAssignedTask(Request $request, $userId) {
        $user = User::findOrFail($userId);
        $assignedTasks = AssignedTask::where('user_id', $userId)->latest()->get();
        $progress = [];
        foreach ($assignedTasks as $task) {
            $latestSubmittedTask = SubmittedTask::where('user_id', $userId)
                ->where('assigned_task_id', $task->id)
                ->latest()
                ->pluck('progress')
                ->first();
    
            $progress[$task->id] = $latestSubmittedTask;
        }
        return view('Dashbord.MyTask', ['assignedTasks' => $assignedTasks,'user'=>$user,'progress' => $progress]);
     }



    public function deleteAssignedTask(Request $request, $id) { 
      
       $task = AssignedTask::find($id);
        $task->delete();

        return redirect()->back()->with('success', 'You are successfully commented');
    }
}
