<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 20:05
 */

namespace Vehicles\Parts;


use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;

class FuelTank
{
    private $hasFuel = false;
    private $fuelType;

    public function __construct(string $fuelType)
    {
        $this->fuelType = $fuelType;
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

    public function useFuel()
    {
        if(!$this->hasFuel()){
            throw new NoFuelException();
        }

        $this->hasFuel = false;
    }

    protected function checkFuel(string $fuel): bool
    {
        return $fuel === $this->fuelType;
    }

    public function getAcceptedFuelType(): string
    {
        return $this->fuelType;
    }
}
