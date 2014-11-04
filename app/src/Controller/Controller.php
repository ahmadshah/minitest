<?php namespace Kraken\Controller;

abstract class Controller
{
    protected $kraken;

    public function __construct($kraken)
    {
        $this->kraken = $kraken;
    }
}
