<?php

namespace App\Hello;

class HelloWorld {
    private $name;

    public function __construct(string $p)
    {
       $this->name = $p;
    }

    public function yo() {
        return 'yo '.$this->name;
    }
}