<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{
    public function hello() {
        return new Response('<html><body><h1>Success!</h1></body></html>');
    }
}