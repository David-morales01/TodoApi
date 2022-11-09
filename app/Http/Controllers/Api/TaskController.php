<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::all(); 
        return TaskResource::make($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
         $data = $request->validate(
             [ 
                 'description'=>['required']
             ]
         ); 
        //
         $task = Task::create($data);
         return TaskResource::make($task);
        // return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

         $data = $request->validate(
            [ 
                'description'=>['required']
            ]
        ); 
        $task->update($data);
        
        return TaskResource::make($task);
    }

    public function complete(Request $request, Task $task)
    {
        $data = $request->validate([
            'completed_at' =>['sometimes']
        ]);
        if($request->completed_at){
            $data['completed_at'] =  now();
        } else{
            $data['completed_at'] = null;
        }

        $task->update($data);
        return TaskResource::make($task);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        
        $task->delete();
        return TaskResource::make($task);
    }
}
