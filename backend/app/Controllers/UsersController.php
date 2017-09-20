<?php namespace App\Controllers;

use App\Http\Requests\FormRequest;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class UsersController
 * @package App\Controllers
 */
class UsersController extends Controller
{
    protected $repository;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->repository = $repository->setCacheDriver( env('CACHE_DRIVER') );
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = [];

        try {

            $response['users'] = $this->repository->findAll();

        } catch (\Exception $e) {
            $response['error'] = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }


    /**
     * @param StoreUserRequest|FormRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $response = [];

        try {

            $data = $request->all();
            Log::info($request->all());

            if (isset($data['image'])) {
                $data['image'] = time().'.'.$request->file('image')->getClientOriginalExtension();
            }

            $request->file('image')->move(public_path('images'), $data['image']);

            $this->repository->create($data);

            $response['status'] = true;

        } catch (\Exception $e) {
            $response['error'] = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

}
