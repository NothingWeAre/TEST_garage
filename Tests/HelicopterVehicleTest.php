<?php

use Exceptions\AlreadyInFlightException;
use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;

class HelicopterVehicleTest extends TestCase
{
    public function testInstantiation()
    {
        $vehicle = new HelicopterVehicle('test');
        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(AerialInterface::class, $vehicle, 'Must implement AerialInterface');
        $this->assertInstanceOf(RequireFuelInterface::class, $vehicle, 'Must implement RequireFuelInterface');

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param RequireFuelInterface $vehicle
     */
    public function testIfHasFuelEmpty(RequireFuelInterface $vehicle)
    {
        $this->assertEquals(
            false,
            $vehicle->getFuelTank()->hasFuel()
        );
    }

    /**
     * @depends testInstantiation
     *
     * @param RequireFuelInterface $vehicle
     */
    public function testRefuelWithIncorrectFuel(RequireFuelInterface $vehicle)
    {
        $this->expectException(IncorrectFuelTypeException::class);
        $vehicle->getFuelTank()->refuel('not fuel');
    }


    /**
     * @depends testInstantiation
     *
     * @param RequireFuelInterface $vehicle
     *
     * @return RequireFuelInterface
     */
    public function testRefuelWithAcceptedFuelType(RequireFuelInterface $vehicle)
    {
        $this->assertEquals(
            'refueled',
            $vehicle->getFuelTank()->refuel($vehicle->getFuelTank()->getAcceptedFuelType())
        );

        $this->assertEquals(
            true,
            $vehicle->getFuelTank()->hasFuel()
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
