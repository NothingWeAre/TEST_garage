<?php
use Exceptions\AlreadyMovingException;
use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use Exceptions\NotMovingException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\CarVehicle;
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
            $vehicle->getFuelTank()->hasFuel()
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
            $vehicle->getFuelTank()->hasFuel()
        );

        return $vehicle;
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
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
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param CarVehicle $vehicle
     *
     * @return CarVehicle
     */
    public function testDrive(CarVehicle $vehicle)
    {
        $this->assertEquals(
            'Drive action successful',
            $vehicle->drive()
        );

        return $vehicle;
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
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
