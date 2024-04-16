<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(protected UserRepositoryInterface $userRepository)
    {

    }

    /**
     * @param $data
     * @return Builder|Model|mixed
     */
    public function create($data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id): mixed
    {
        return $this->userRepository->update($data, $id);
    }

    /**
     * @param array $columns
     * @param array $with
     * @return array|Collection
     */
    public function userList(array $columns, array $with): Collection|array
    {
        return $this->userRepository->userListWithoutCurrentUser($columns, $with);
    }

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function find($id, array $with): mixed
    {
        return $this->userRepository->find($id, $with);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOneOrFail($id): mixed
    {
        return $this->userRepository->findOneOrFail($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->userRepository->delete($id);
    }

}
