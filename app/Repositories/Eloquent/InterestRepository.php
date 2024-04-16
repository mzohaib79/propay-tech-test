<?php

namespace App\Repositories\Eloquent;

use App\Models\Interest;
use App\Models\User;
use App\Repositories\InterestRepositoryInterface;

/**
 * Class InterestRepository
 * @package App\Repositories\Eloquent
 */
class InterestRepository extends BaseRepository implements InterestRepositoryInterface
{
    /**
     * @param Interest $interest
     */
    public function __construct(Interest $interest)
    {
        parent::__construct($interest);
    }

}
