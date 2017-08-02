<?php

use Exceptions\IncorrectFuelTypeException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;

class HelicopterVehicleTest extends TestCase
{
    public function testInstantiation()
    {
        $vehicle = new HelicopterVehicle('test');
        $this->assertInstanceOf(AbstractVehicle::class, $vehicle,'Must extend AbstractVehicle');
        $this->assertInstanceOf(AerialInterface::class, $vehicle,'Must implement AerialInterface');
        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testRefuelWithIncorrectFuel(HelicopterVehicle $vehicle)
    {
        $this->expectException(IncorrectFuelTypeException::class);

        $vehicle->refuel('not fuel');
    }


    /**
     * @depends testInstantiation
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testRefuelWithAcceptedFuelType(HelicopterVehicle $vehicle){
        $this->assertEquals(
            'refueled',
            $vehicle->refuel($vehicle->getAcceptedFuelType())
        );
    }


    public function testOperations(HelicopterVehicle $vehicle)
    {

        $this->assertEquals(
            'Take-off action successful',
            $vehicle->takeOff()
        );

    }
}
