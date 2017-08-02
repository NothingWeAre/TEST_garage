<?php

use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use PHPUnit\Framework\TestCase;
use Vehicles\Parts\FuelTank;

/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 21:08
 */
class FuelTankTest extends TestCase
{

    public function testInstantiation()
    {
        $fuelTank = new FuelTank('testFuel');

        $this->assertEquals(
            'testFuel',
            $fuelTank->getAcceptedFuelType()
        );

        return $fuelTank;
    }

    /**
     * @depends testInstantiation
     *
     * @param FuelTank $fuelTank
     */
    public function testIfHasFuelEmpty(FuelTank $fuelTank)
    {
        $this->assertEquals(
            false,
            $fuelTank->hasFuel()
        );
    }

    /**
     * @depends testInstantiation
     *
     * @param FuelTank $fuelTank
     */
    public function testRefuelWithIncorrectFuel(FuelTank $fuelTank)
    {
        $this->expectException(IncorrectFuelTypeException::class);
        $fuelTank->refuel('not fuel');
    }


    /**
     * @depends testInstantiation
     *
     * @param FuelTank $fuelTank
     *
     * @return FuelTank
     */
    public function testRefuelWithAcceptedFuelType(FuelTank $fuelTank)
    {
        $this->assertEquals(
            'refueled',
            $fuelTank->refuel($fuelTank->getAcceptedFuelType())
        );

        $this->assertEquals(
            true,
            $fuelTank->hasFuel()
        );

        return $fuelTank;
    }

    /**
     * @depends testInstantiation
     *
     * @param FuelTank $fuelTank
     */
    public function testUseFuelWithFullTank(FuelTank $fuelTank){
        $fuelTank->useFuel();
        $this->assertEquals(
            false,
            $fuelTank->hasFuel()
        );
    }

    /**
     * @depends testInstantiation
     *
     * @param FuelTank $fuelTank
     */
    public function testUseFuelWithEmptyTank(FuelTank $fuelTank){
        $this->expectException(NoFuelException::class);
        $fuelTank->useFuel();
    }
}
