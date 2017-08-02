<?php
/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 21:05
 */

use Exceptions\AlreadyInFlightException;
use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use Exceptions\NotInFlightException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
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
     * @depends testRefuelWithAcceptedFuelType
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
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param SpaceShuttleVehicle $vehicle
     */
    public function testFlyWithoutTakeOff(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NotInFlightException::class);
        $vehicle->fly();
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param SpaceShuttleVehicle $vehicle
     *
     * @return SpaceShuttleVehicle
     */
    public function testTakeOff(SpaceShuttleVehicle $vehicle)
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
    public function testTakeOffWithEmptyTank(SpaceShuttleVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->takeOff();
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
