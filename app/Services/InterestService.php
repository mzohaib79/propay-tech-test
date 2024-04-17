<?php

namespace App\Services;

use App\Repositories\InterestRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class InterestService
{
    /**
     * @var InterestRepositoryInterface
     */
    protected InterestRepositoryInterface $interestRepository;
    /**
     * @param InterestRepositoryInterface $interestRepository
     */
    public function __construct(InterestRepositoryInterface $interestRepository)
    {
        $this->interestRepository = $interestRepository;
    }

    /**
     * @return Builder[]|Collection|mixed
     */
    public function all(): mixed
    {
        return $this->interestRepository->all();
    }
}
