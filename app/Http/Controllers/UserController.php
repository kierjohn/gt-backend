<?php 

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->all();
        return response()->json($users);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        return response()->json($user, 201);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userRepository->find($id);
        // Exclude password update
        unset($data['password']);
        $this->userRepository->update($user, $data);
        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        $this->userRepository->delete($user);
        return response()->json(null, 204);
    }
}


?>