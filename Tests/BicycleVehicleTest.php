<?php

use Exceptions\AlreadyMovingException;
use Exceptions\NotMovingException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\BicycleVehicle;
use Vehicles\VehicleTypeInterface\TerrainInterface;

/**
 * Created by PhpStorm.
 * User: Gideon
 * Date: 02.08.2017
 * Time: 20:59
 */

class BicycleVehicleTest extends TestCase
{
    public function testInstantiation(AbstractVehicle $vehicle = null)
    {
        if(empty($vehicle)){
            $vehicle = new BicycleVehicle('test');
        }

        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(TerrainInterface::class, $vehicle, 'Must implement TerrainInterface');
        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param BicycleVehicle $vehicle
     *
     * @return BicycleVehicle
     */
    public function testStopWhenNotMoving(BicycleVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param BicycleVehicle $vehicle
     *
     * @return BicycleVehicle
     */
    public function testDrive(BicycleVehicle $vehicle)
    {
        $this->assertEquals(
            'Drive action successful',
            $vehicle->drive()
        );

        return $vehicle;
    }

    /**
     * @depends testDrive
     *
     * @param BicycleVehicle $vehicle
     */
    public function testDriveWhenMoving(BicycleVehicle $vehicle)
    {
        $this->expectException(AlreadyMovingException::class);
        $vehicle->drive();
    }

    /**
     * @depends testDrive
     *
     * @param BicycleVehicle $vehicle
     *
     * @return BicycleVehicle
     */
    public function testStop(BicycleVehicle $vehicle)
    {
        $this->assertEquals(
            'Stop action successful',
            $vehicle->stop()
        );

        return $vehicle;
    }

    /**
     * @depends testStop
     *
     * @param BicycleVehicle $vehicle
     */
    public function testStopWhenStopped(BicycleVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();
    }
}
