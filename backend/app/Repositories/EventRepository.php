<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class EventRepository extends EloquentRepository
{
    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Event::class)
            ->setRepositoryId('event_repository');

    }
}