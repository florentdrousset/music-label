<?php

namespace App\Hello;

use App\Magnifier\Magnifier;
use Psr\Container\ContainerInterface;

class HelloWorld {
    private $name;
    private $m;
    private $container;

    public function __construct(string $p, string $prenom, Magnifier $m)
    {
       $this->name = $prenom;
       $this->magnifier = $m;
    }

    public function yo() {
        return 'yo '.$this->name;
    }

    public function yoUpper() {
        return $this->magnifier->upper($this->yo());
    }

    public function setContainer(ContainerInterface $c) {
        $this->container = $c;
    }
}