<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class WelcomeController {
    public function salut() {
        return new Response(
            'Salut !'
        );
    }
}
