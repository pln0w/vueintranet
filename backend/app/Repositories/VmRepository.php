<?php

namespace App\Repositories;

use App\Models\Vm;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class VmRepository extends EloquentRepository
{
    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Vm::class)
            ->setRepositoryId('vm_repository');

    }
}