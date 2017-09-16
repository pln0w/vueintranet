<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Contracts\Container\Container;
use Rinvex\Repository\Repositories\EloquentRepository;

class WebsiteRepository extends EloquentRepository
{
    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Website::class)
            ->setRepositoryId('website_repository');

    }
}