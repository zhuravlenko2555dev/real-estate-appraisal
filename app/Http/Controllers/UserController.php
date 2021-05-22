<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request) {
        $response = $this->userRepository->login($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function register(Request $request) {
        $response = $this->userRepository->register($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function user(Request $request) {
        $response = $this->userRepository->user($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function refreshToken(Request $request) {
        $response = $this->userRepository->refreshToken($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function logout(Request $request) {
        $response = $this->userRepository->logout($request);
        return response()->json($response["data"], $response["statusCode"]);
    }
}
