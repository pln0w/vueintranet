<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    /**
     * Instantiate repository object with required data
     *
     * UserRepository constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(User::class)
            ->setRepositoryId('user_repository');

    }

    public function create(array $attributes = [], bool $syncRelations = false)
    {
        return parent::create($attributes, $syncRelations);
    }
}