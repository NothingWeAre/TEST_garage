<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 21:05
 */

use Exceptions\AlreadyInFlightException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\Parts\FuelTank;
use Vehicles\SpaceShuttleVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;

class SpaceShuttleVehicleTest extends TestCase
{
    public function testInstantiation()
    {
        $vehicle = new SpaceShuttleVehicle('test');
        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(AerialInterface::class, $vehicle, 'Must implement AerialInterface');
        $this->assertInstanceOf(RequireFuelInterface::class, $vehicle, 'Must implement RequireFuelInterface');

        return $vehicle;
    }


    /**
     * @depends testInstantiation
     *
     * @param SpaceShuttleVehicle $vehicle
     *
     * @return SpaceShuttleVehicle
     */
    public function testMusicOn(SpaceShuttleVehicle $vehicle)
    {
        $this->assertEquals(
            'You are listening to music',
            $vehicle->musicOn()
        );

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testLandingOnLand(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NotInFlightException::class);
        $vehicle->land();
    }

    /**
     * @depends testInstantiation
     *
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testFlyWithoutTakeOff(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NotInFlightException::class);
        $vehicle->fly();
    }

    /**
     * @depends testInstantiation
     *
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testTakeOffWithEmptyTank(SpaceShuttleVehicle $vehicle)
    {
        $this->createMock(FuelTank::class)->method('hasFuel')->willReturn(false);
        $this->expectException(NoFuelException::class);
        $vehicle->takeOff();
    }

    /**
     * @depends testInstantiation
     *
     * @param SpaceShuttleVehicle $vehicle
     *
     * @return SpaceShuttleVehicle
     */
    public function testTakeOff(SpaceShuttleVehicle $vehicle)
    {
        $vehicle->getFuelTank()->refuel($vehicle->getFuelTank()->getAcceptedFuelType());
        $this->assertEquals(
            'Take-off action successful',
            $vehicle->takeOff()
        );

        return $vehicle;
    }

    /**
     * @depends testTakeOff
     *
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testTakeOffInFlight(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(AlreadyInFlightException::class);
        $vehicle->takeOff();
    }

    /**
     * @depends testTakeOff
     *
     * @param SpaceShuttleVehicle $vehicle
     *
     * @return SpaceShuttleVehicle
     */
    public function testFly(SpaceShuttleVehicle $vehicle)
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
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testFuelExpenditure(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->fly();
    }

    /**
     * @depends testFly
     *
     * @param SpaceShuttleVehicle $vehicle
     *
     * @return SpaceShuttleVehicle
     */
    public function testLanding(SpaceShuttleVehicle $vehicle)
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
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testFlyWithEmptyTank(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->fly();
    }
}
