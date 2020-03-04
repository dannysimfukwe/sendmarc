<?php 
namespace App\Http\Repository;

use App\Task;

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
        if ($this->name != 'Get Older') {
            if ($this->priority < 100 && $this->name != 'Breathe') {
                $this->priority = $this->priority + 1;
            }
            if ($this->name == 'Complete Assessment') {
                if ($this->dueIn < 11 && $this->priority < 100) {
                    $this->priority = $this->priority + 1;
                }
                if ($this->dueIn < 6 && $this->priority < 100) {
                    $this->priority = $this->priority + 1;
                }
            }
        } else {
            if ($this->priority > 0) {
                $this->priority = $this->priority - 1;
            }
        }
        if ($this->name != 'Breathe') {
            $this->dueIn = $this->dueIn - 1;
        }
        if ($this->dueIn < 0) {
            if ($this->name != 'Get Older') {
                if ($this->name != 'Complete Assessment') {
                    if ($this->priority < 100 && $this->name != 'Breathe') {
                        $this->priority = $this->priority + 1;
                    }
                } else {
                    $this->priority = $this->priority - $this->priority;
                }
            } else {
                if ($this->priority > 0) {
                    $this->priority = $this->priority - 1;
                }
            }
        }
    }


}