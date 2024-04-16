<?php

namespace App\Http\Controllers;

use App\Events\NewUserCreated;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserInterestService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * @param UserService $userService
     * @param UserInterestService $userInterestService
     */
    public function __construct(protected UserService $userService, protected UserInterestService $userInterestService)
    {

    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function index(Request $request): mixed
    {
        if ($request->ajax()) {
            $userList = $this->userService->userList(['*'], ['interests']);
            return Datatables::of($userList)
                ->addIndexColumn()
                ->editColumn('interest', function ($user) {
                    if ($user->interests->isEmpty()) {
                        return ''; // Return early if there are no interests
                    }

                    // Use the map method on the Eloquent collection to generate interest badges
                    $interestBadges = $user->interests->map(function ($interest) {
                        // Use htmlspecialchars to prevent XSS
                        $interestName = htmlspecialchars($interest->name, ENT_QUOTES, 'UTF-8');
                        return '<span class="shadow-none badge badge-primary">' . $interestName . '</span>';
                    });

                    // Join the badges into a single string using implode with a space separator
                    return $interestBadges->implode(' ');

                })
                ->addColumn('action', function ($user) {
                    return view('components.user-actions', ['user' => $user])->render();
                })
                ->rawColumns(['action', 'interest'])
                ->make(true);
        }

        $interests = $this->userInterestService->all();
        return view('user.index', compact('interests'));
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            if (!empty($request->user_id)) {
                $user = $this->userService->update($request->all(), $request->user_id);
                $message = 'User updated successfully.';
            } else {
                $user = $this->userService->create($request->all());
                $message = 'User saved successfully';
            }
             $user->interests()->sync($request->interests);

            if (empty($request->user_id)) {
                NewUserCreated::dispatch($user);
            }
            return response()->json([
                'status' => 200,
                'type' => 'success',
                'message' => $message,
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => 300,
                'type' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->userService->find($id, ['interests']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->userService->delete($id);
            return response()->json([
                'status' => 200,
                'type' => 'success',
                'message' => 'User deleted successfully.',
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'status' => 300,
                'type' => 'error',
                'message' => 'An unexpected error occurred. Please try again later.',
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
        }

    }
}
