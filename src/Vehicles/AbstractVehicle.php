<?php

namespace Vehicles;

use Exceptions\IncorrectFuelTypeException;

abstract class AbstractVehicle
{
    private $hasFuel = false;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function refuel(string $fuel): string
    {
        if(!$this->checkFuel($fuel)){
            throw new IncorrectFuelTypeException($this->getAcceptedFuelType(), $fuel);
        }

        $this->hasFuel = true;

        return 'refueled';
    }

    public function hasFuel(): bool
    {
        return $this->hasFuel;
    }

    protected function useFuel()
    {
        $this->hasFuel = false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract protected function checkFuel(string $fuel): bool;

    abstract public function getAcceptedFuelType(): string;
}
