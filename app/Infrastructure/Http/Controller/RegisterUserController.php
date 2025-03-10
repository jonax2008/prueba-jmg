<?php

namespace App\Infrastructure\Http\Controller;

use App\Application\User\RegisterUserRequest;
use App\Application\User\UserService;
use App\Application\User\DTO\UserResponseDTO;

class RegisterUserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(array $requestData): void
    {
        $request = new RegisterUserRequest(
            $requestData['name'],
            $requestData['email'],
            $requestData['password']
        );

        try {
            $request = new RegisterUserRequest(
                $data['id'] ?? '',
                $data['name'] ?? '',
                $data['email'] ?? '',
                $data['password'] ?? ''
            );

            $user = $this->userService->registerUser($request);
            $response = new UserResponseDTO($user);

            http_response_code(201);
            echo json_encode(['message' => 'User registered successfully']);
        } catch (\InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }

        header('Content-Type: application/json');
        echo json_encode($response->toArray());
    }
}
