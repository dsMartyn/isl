<?php

namespace Src\Controllers\Partials;

use Symfony\Component\HttpFoundation\Cookie;

trait SaveSession
{

    public function __after()
    {

        $container = \App\sage();

        $container['session']->save();

        // The session is saved; now, we'll store the session ID in a cookie to allow for
        // the session to remain on future requests
        $cookie = new Cookie(
            $container['session']->getName(),
            $container['session']->getId(),
            time() + ($container['config']['session.lifetime'] * 60),
            $container['config']['session.path'],
            $container['config']['session.domain'],
            $container['config']['session.secure']
        );

        setcookie(
            $cookie->getName(),
            $cookie->getValue(),
            $cookie->getExpiresTime(),
            $cookie->getPath(),
            $cookie->getDomain()
        );

    }

    public function test2()
    {

        return "hello";

    }

}
