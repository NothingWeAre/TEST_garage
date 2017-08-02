<?php
use Exceptions\AlreadyMovingException;
use Exceptions\NoFuelException;
use Exceptions\NotMovingException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\CarVehicle;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;
use Vehicles\VehicleTypeInterface\TerrainInterface;

class CarVehicleTest extends TestCase
{
    public function testInstantiation(AbstractVehicle $vehicle = null)
    {
        if(empty($vehicle)){
            $vehicle = new CarVehicle('test');
        }

        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(TerrainInterface::class, $vehicle, 'Must implement TerrainInterface');
        $this->assertInstanceOf(RequireFuelInterface::class, $vehicle, 'Must implement RequireFuelInterface');
        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param CarVehicle $vehicle
     *
     * @return CarVehicle
     */
    public function testStopWhenNotMoving(CarVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param CarVehicle $vehicle
     *
     * @return CarVehicle
     */
    public function testDrive(CarVehicle $vehicle)
    {
        $vehicle->getFuelTank()->refuel($vehicle->getFuelTank()->getAcceptedFuelType());
        $this->assertEquals(
            'Drive action successful',
            $vehicle->drive()
        );

        return $vehicle;
    }

    /**
     * @depends testInstantiation
     *
     * @param CarVehicle $vehicle
     *
     * @return CarVehicle
     */
    public function testMusicOn(CarVehicle $vehicle)
    {
        $this->assertEquals(
            'You are listening to music',
            $vehicle->musicOn()
        );

        return $vehicle;
    }

    /**
     * @depends testDrive
     *
     * @param CarVehicle $vehicle
     */
    public function testDriveWhenMoving(CarVehicle $vehicle)
    {
        $this->expectException(AlreadyMovingException::class);
        $vehicle->drive();
    }

    /**
     * @depends testDrive
     *
     * @param CarVehicle $vehicle
     *
     * @return CarVehicle
     */
    public function testStop(CarVehicle $vehicle)
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
     * @param CarVehicle $vehicle
     */
    public function testStopWhenStopped(CarVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();
    }

    /**
     * @depends testStop
     *
     * @param CarVehicle $vehicle
     */
    public function testDriveWithEmptyTank(CarVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->drive();
    }
}
