<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 20:39
 */

namespace Vehicles\FunctionTraits;


use Vehicles\Parts\FuelTank;

trait FuelTankTrait
{
    /**
     * @var FuelTank
     */
    protected $fuelTank;

    public function getFuelTank(): FuelTank
    {
        return $this->fuelTank;
    }

    protected function setFuelTank(FuelTank $fuelTank)
    {
        $this->fuelTank = $fuelTank;
    }
}
