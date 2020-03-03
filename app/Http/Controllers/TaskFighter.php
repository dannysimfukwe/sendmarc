<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repository\TaskManager;

class TaskFighter extends Controller
{
    public function tasks(){

        $tasks = (new TaskManager(null, null, null))->all();

        return response()->json($tasks);
    }

    public function create(Request $request){

        $task = (new TaskManager(null, null, null))->create($request);

        return response()->json($task);
    }


    public function delete($id){

        $task = (new TaskManager(null, null, null))->delete($id);

        return response()->json($task);
    }
   

    public function tick() {

        $tick = (new TaskManager(null, null, null))->listTick();

        return response()->json($tick);
    }
}
