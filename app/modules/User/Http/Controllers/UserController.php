<?php

namespace App\modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\modules\User\Dto\CreateUser;
use App\modules\User\Dto\UpdateUser;
use App\modules\User\Http\Models\Team;
use App\modules\User\Http\Models\User;
use App\modules\User\Http\Requests\StoreUserRequest;
use App\modules\User\Http\Requests\UpdateUserRequest;
use App\modules\User\Contracts\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users = $this->userRepository->all();

        return view('modules.user.index', compact('users'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $teams = Team::all();

        return view('modules.user.create', compact('teams'));
    }

    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userRepository->create(CreateUser::fromValidatedRequest($request->validated()));

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $teams = Team::all();

        return view('modules.user.create', compact('user', 'teams'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userRepository->update($user, UpdateUser::fromValidatedRequest($request->validated()));

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userRepository->delete($user);

        return redirect()->route('users.index');
    }
}
