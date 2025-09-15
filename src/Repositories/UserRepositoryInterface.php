<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Summary of findAll
     * @return array<User>
     */
    public function findAll(): array;
    public function findById(int $id): ?User;
    public function save(User $user): User;
    /**
     * Summary of update
     * @param array<string> $data
     * @param int $id
     * @return User|null
     */
    public function update(array $data, int $id): ?User;
    public function delete(int $id): bool;
}