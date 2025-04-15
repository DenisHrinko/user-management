<?php

namespace App\modules\User\Repositories;

use App\modules\User\Dto\CreateUser;
use App\modules\User\Dto\UpdateUser;
use App\modules\User\Http\Models\User;
use App\modules\User\Contracts\UserRepository as UserRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryContract
{

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::with('teams')->get();
    }

    /**
     * @param CreateUser $userDto
     * @return User
     */
    public function create(CreateUser $userDto): User
    {
        $user = User::create([
            'name' => $userDto->name,
            'email' => $userDto->email,
            'password' => $userDto->password,
        ]);

        $this->syncTeams($user, $userDto->teams);

        return $user;
    }

    /**
     * @param User $user
     * @param UpdateUser $userDto
     * @return User
     */
    public function update(User $user, UpdateUser $userDto): User
    {
        $user->update([
            'name' => $userDto->name,
            'email' => $userDto->email,
            'password' => $userDto->password ?? $user->password,
        ]);

        $this->syncTeams($user, $userDto->teams);

        return $user;
    }

    /**
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user): ?bool
    {
        $user->teams()->detach();

        return $user->delete();
    }

    /**
     * @param User $user
     * @param array $teamIds
     * @return void
     */
    private function syncTeams(User $user, array $teamIds): void
    {
        $user->teams()->sync($teamIds);
    }
}
