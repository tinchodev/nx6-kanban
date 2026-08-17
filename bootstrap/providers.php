<?php

return [
    GitScrum\Providers\AppServiceProvider::class,
    GitScrum\Providers\AuthServiceProvider::class,
    // GitScrum\Providers\BroadcastServiceProvider::class,
    GitScrum\Providers\ModelObserverProvider::class,
    GitScrum\Providers\EventServiceProvider::class,
    GitScrum\Providers\SlackServiceProvider::class,

    SocialiteProviders\Manager\ServiceProvider::class,
];
