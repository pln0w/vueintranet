<?php

namespace App\Repositories;

use App\Models\Server;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class ServerRepository extends EloquentRepository
{
    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Server::class)
            ->setRepositoryId('server_repository');

    }
}