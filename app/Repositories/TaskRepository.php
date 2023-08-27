<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function find(int $id)
    {
        return Task::findOrFail($id);
    }

    public function getAllUserTasks(int $userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    // Implement search method
}


?>