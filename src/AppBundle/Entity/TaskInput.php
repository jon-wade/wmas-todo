<?php
namespace AppBundle\Entity;

class TaskInput
{
    protected $taskInput;

    public function getTask()
    {
        return $this->taskInput;
    }

    public function setTask($task)
    {
        $this->taskInput = $task;
    }
}