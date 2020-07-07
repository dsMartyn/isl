<?php

namespace Services\Support;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Session\SessionManager;
use Symfony\Component\HttpFoundation\Response;

class SessionServiceProvider
{

    public function boot()
    {

        // this class does not need a boot

    }

    public function register()
    {

        $container = \App\sage();

        $container->bindIf('files', function() {
            return new Filesystem();
        });

        $sessionManager = new SessionManager($container);

        $request = Request::createFromGlobals();

        (new StartSession($sessionManager))->handle($request, function($request) {
            return new Response();
        });

        $container->bindIf('session.store', function() use ($sessionManager) {
            return $sessionManager->driver();
        });

        $container->bindIf('session', function() use ($sessionManager) {
            return $sessionManager;
        }, true);

        $cookieName = $container['session']->getName();

        if (isset($_COOKIE[$cookieName])) {
            if ($sessionId = $_COOKIE[$cookieName]) {
                $container['session']->setId($sessionId);
            }
        }

        $container['session']->start();

    }

}