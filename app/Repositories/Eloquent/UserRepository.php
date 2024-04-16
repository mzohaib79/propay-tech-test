<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @param $columns
     * @param $with
     * @return array|Collection
     */
    public function userListWithoutCurrentUser($columns, $with): array|Collection
    {
        return $this->model
            ->with($with)
            ->where('id', '!=', auth()->id() )
            ->get($columns);
    }
}
