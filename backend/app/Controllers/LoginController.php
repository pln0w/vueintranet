<?php namespace App\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;

class LoginController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->repository = $repository->setCacheDriver( env('CACHE_DRIVER') );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $response = [];
        $username = $request->input('username');
        $password = $request->input('password');

        try {

            if (Auth::attempt(['email' => $username, 'password' => $password])) {

                $user = $this->repository->findBy('email', $username);

                if ($user) {

                    $token = JWTAuth::fromUser($user);

                    $response['user'] = $user;
                    $response['token'] = $token;
                }

            } else {
                throw new InvalidCredentialsException;
            }

        } catch (\Exception $e) {
            $response['error'] = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $response = [];

        try {

            Auth::guard()->logout();

            $request->session()->flush();
            $request->session()->regenerate();

        } catch (\Exception $e) {
            $response['error'] = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }
}
