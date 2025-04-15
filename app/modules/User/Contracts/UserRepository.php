<?php

namespace App\modules\User\Contracts;

use App\modules\User\Dto\CreateUser;
use App\modules\User\Dto\UpdateUser;
use App\modules\User\Http\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param CreateUser $userDto
     * @return User
     */
    public function create(CreateUser $userDto): User;

    /**
     * @param User $user
     * @param UpdateUser $userDto
     * @return User
     */
    public function update(User $user, UpdateUser $userDto): User;

    /**
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user): ?bool;
}
