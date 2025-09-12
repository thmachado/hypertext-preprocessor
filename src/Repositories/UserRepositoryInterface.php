<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?User;
    public function save(User $user): User;
    public function update(array $data, int $id): ?User;
    public function delete(int $id): bool;
}