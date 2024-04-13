<?php

return [
    /*
     * Package Service Providers...
     */
    PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider::class,
    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    App\Providers\ServiceServiceProvider::class,
    App\Providers\UseCaseServiceProvider::class,
];
