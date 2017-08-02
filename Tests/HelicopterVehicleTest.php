<?php

use Exceptions\AlreadyInFlightException;
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
     * @param AbstractVehicle $vehicle
     */
    public function testIfHasFuelEmpty(AbstractVehicle $vehicle)
    {
        $this->assertEquals(
            false,
            $vehicle->hasFuel()
        );
    }

    /**
     * @depends testInstantiation
     *
     * @param AbstractVehicle $vehicle
     */
    public function testRefuelWithIncorrectFuel(AbstractVehicle $vehicle)
    {
        $this->expectException(IncorrectFuelTypeException::class);
        $vehicle->refuel('not fuel');
    }


    /**
     * @depends testInstantiation
     *
     * @param AbstractVehicle $vehicle
     *
     * @return AbstractVehicle
     */
    public function testRefuelWithAcceptedFuelType(AbstractVehicle $vehicle)
    {
        $this->assertEquals(
            'refueled',
            $vehicle->refuel($vehicle->getAcceptedFuelType())
        );

        $this->assertEquals(
            true,
            $vehicle->hasFuel()
        );

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testLandingOnLand(HelicopterVehicle $vehicle)
    {
        $this->expectException(NotInFlightException::class);
        $vehicle->land();
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

    /**
     * @depends testTakeOff
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testTakeOffInFlight(HelicopterVehicle $vehicle)
    {
        $this->expectException(AlreadyInFlightException::class);
        $vehicle->takeOff();
    }

    /**
     * @depends testTakeOff
     *
     * @param HelicopterVehicle $vehicle
     *
     * @return HelicopterVehicle
     */
    public function testFly(HelicopterVehicle $vehicle)
    {
        $this->assertEquals(
            'Fly action successful',
            $vehicle->fly()
        );

        return $vehicle;
    }

    /**
     * @depends testFly
     *
     * @param HelicopterVehicle $vehicle
     */
    public function testFuelExpenditure(HelicopterVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->fly();
    }

    /**
     * @depends testFly
     *
     * @param HelicopterVehicle $vehicle
     *
     * @return HelicopterVehicle
     */
    public function testLanding(HelicopterVehicle $vehicle)
    {
        $this->assertEquals(
            'Land action successful',
            $vehicle->land()
        );

        return $vehicle;
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
}
