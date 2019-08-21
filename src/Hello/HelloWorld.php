<?php

namespace App\Hello;

use App\Magnifier\Magnifier;

class HelloWorld {
    private $name;
    private $m;

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
}