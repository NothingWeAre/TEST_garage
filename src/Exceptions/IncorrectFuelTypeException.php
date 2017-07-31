<?php

namespace Exceptions;

class IncorrectFuelTypeException extends \Exception
{
    private $expectedFuel;
    private $actualFuel;

    public function __construct(string $expectedFuel, string $actualFuel)
    {
        $this->expectedFuel = $expectedFuel;
        $this->actualFuel   = $actualFuel;
        parent::__construct(sprintf('Expected "%s", got "%s"', $expectedFuel, $actualFuel));
    }

    public function getExpectedFuel()
    {
        return $this->expectedFuel;
    }

    public function setExpectedFuel(string $expectedFuel): IncorrectFuelTypeException
    {
        $this->expectedFuel = $expectedFuel;
        return $this;
    }

    public function getActualFuel()
    {
        return $this->actualFuel;
    }

    public function setActualFuel(int $actualFuel): IncorrectFuelTypeException
    {
        $this->actualFuel = $actualFuel;
        return $this;
    }

}
