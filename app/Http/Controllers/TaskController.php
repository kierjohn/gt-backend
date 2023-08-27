<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function store(CreateTaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = $this->taskRepository->create($data);
        return response()->json($task, 201);
    }

    public function getAllUserTasks(int $userId): JsonResponse
    {
        $tasks = $this->taskRepository->getAllUserTasks($userId);
        return response()->json($tasks);
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $task = $this->taskRepository->find($id);
        $this->taskRepository->update($task, $data);
        return response()->json($task);
    }

    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskRepository->find($id);
        $this->taskRepository->delete($task);
        return response()->json(null, 204);
    }

    // Implement other methods
}

?>