<?php


namespace App\Repositories;


use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;
        $device_name = $request->device_name;

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            $data = ['error' => self::UNAUTHORISED_STATUS_TEXT];
            $statusCode = self::UNAUTHORISED_STATUS_CODE;
            return $this->response($data, $statusCode);
        }

        $data = ['access_token' => $user->createToken($device_name)->plainTextToken, 'expires_in' => config('sanctum.expiration') * 60];
        $statusCode = self::SUCCESS_STATUS_CODE;
        return $this->response($data, $statusCode);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return $this->response(['message' => 'Successfully registered'], self::SUCCESS_STATUS_CODE);
    }

    public function user(Request $request) {
        return $this->response($request->user(), self::SUCCESS_STATUS_CODE);
    }

    public function refreshToken(Request $request) {
        $currentAccessToken = $request->user()->currentAccessToken();
        $device_name = $currentAccessToken->name;
        $currentAccessToken->delete();

        $data = ['access_token' => $request->user()->createToken($device_name)->plainTextToken, 'expires_in' => config('sanctum.expiration') * 60];
        $statusCode = self::SUCCESS_STATUS_CODE;
        return $this->response($data, $statusCode);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->response(['message' => 'Successfully logged out'], self::SUCCESS_STATUS_CODE);
    }
}
