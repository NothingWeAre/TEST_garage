<?php

use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;

class HelicopterVehicleTest extends TestCase
{
    public function testInstantiation()
    {
        $vehicle = new HelicopterVehicle('test');
        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(AerialInterface::class, $vehicle, 'Must implement AerialInterface');
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
    public function testTakeOffWithEmptyTank(HelicopterVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->takeOff();
    }

    /**
     * @depends testInstantiation
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testFlyWithEmptyTank(HelicopterVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->fly();
    }

    /**
     * @depends testInstantiation
     *
     * @param HelicopterVehicle $vehicle
     *
     * @return HelicopterVehicle
     */
    public function testRefuelWithAcceptedFuelType(HelicopterVehicle $vehicle)
    {
        $this->assertEquals(
            'refueled',
            $vehicle->refuel($vehicle->getAcceptedFuelType())
        );

        return $vehicle;
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testFlyWithoutTakeOff(HelicopterVehicle $vehicle)
    {
        $this->expectException(NotInFlightException::class);
        $vehicle->fly();
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param HelicopterVehicle $vehicle
     *
     * @return HelicopterVehicle
     */
    public function testTakeOff(HelicopterVehicle $vehicle)
    {
        $this->assertEquals(
            'Take-off action successful',
            $vehicle->takeOff()
        );

        return $vehicle;
    }
}
