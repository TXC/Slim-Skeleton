<?php

declare(strict_types=1);

// PHP-DI will take all the definitions it can find and compile them.
// Defined injections are usually for 3rd party libraries, that need
// some kind of configuration to be used.
// see: https://php-di.org/doc/php-definitions.html

use App\Application\Handlers\DoctrineStorage;
use Slim\Csrf\Guard;
use TXC\Box\Environment\Settings;


return [
    Guard::class => function (\DI\Container $container, Settings $settings): Guard {
        $storage = \DI\autowire(DoctrineStorage::class);
        return new Guard(
            $container->get(\Slim\App::class),
            $settings->get('csrf.prefix'),
            $storage,
            function () {
                throw new \App\Exceptions\GuardInvalidCsrfException();
            }
        );
    },
];
