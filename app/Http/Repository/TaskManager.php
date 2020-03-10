<?php 
namespace App\Http\Repository;

use App\Task;
use App\Http\Repository\TaskStatus;

Class TaskManager {

    public $name;

    public $priority;

    public $dueIn;

    
    
    public function __construct($name, $priority, $due_in) {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $due_in;
    }

    public function all() {

        $tasks = Task::all();

        return $tasks;
    }
   
    public function create($request) {

        Task::create(['name' => $request->name, 'priority' => $request->priority, 'dueIn', $request->dueIn]);

        return 'created';
    }

    public function delete($id) {

        Task::find($id)->delete();

        return 'deleted';
    }
    
    public function listTick() {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $taskFighter = new self($task->name, $task->priority, $task->dueIn);
            $taskFighter->tick();
            Task::where('id', $task->id)->update(['priority' => $taskFighter->priority, 'dueIn' => $taskFighter->dueIn]);
        }
        return 'tick';
    }

    private function tick()
    {
        if ($this->name != TaskStatus::GET_OLDER) {
            if ($this->priority < 100 && $this->name != TaskStatus::BREATHE) {
                $this->priority = $this->priority + 1;
            }
            $this->complete();
        } else {
            $this->priority = $this->priority - 1;
        }
        if ($this->name != TaskStatus::BREATHE) {
            $this->dueIn = $this->dueIn - 1;
        }
        if ($this->dueIn < 0) {
            if ($this->name != TaskStatus::GET_OLDER && $this->name != TaskStatus::COMPLETE) {
               
                    if ($this->priority < 100 && $this->name != TaskStatus::BREATHE) {
                        $this->priority = $this->priority + 1;
                    }
    
            } else {
                    $this->priority = $this->priority - $this->priority;
                if ($this->priority > 0) {
                    $this->priority = $this->priority - 1;
                }
            }
        }
    }

    private function complete() {
        if ($this->name == TaskStatus::COMPLETE) {
            if ($this->dueIn < 11 && $this->priority < 100) {
                $this->priority = $this->priority + 1;
            }
        }
    }


}