<?php

namespace App\Services;

use App\Repositories\InterestRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserInterestService
{
    /**
     * @param InterestRepositoryInterface $interestRepository
     */
    public function __construct(protected InterestRepositoryInterface $interestRepository)
    {

    }

    /**
     * @return Builder[]|Collection|mixed
     */
    public function all(): mixed
    {
        return $this->interestRepository->all();
    }
}
