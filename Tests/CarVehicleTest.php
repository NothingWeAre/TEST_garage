<?php
use Exceptions\AlreadyMovingException;
use Exceptions\IncorrectFuelTypeException;
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
