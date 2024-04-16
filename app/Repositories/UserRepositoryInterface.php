<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @param $columns
     * @param $with
     * @return array|Collection
     */
    public function userListWithoutCurrentUser($columns, $with): array|Collection;
}
