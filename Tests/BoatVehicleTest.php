<?php
use Exceptions\AlreadyMovingException;
use Exceptions\IncorrectFuelTypeException;
use Exceptions\NoFuelException;
use Exceptions\NotMovingException;
use PHPUnit\Framework\TestCase;
use Vehicles\AbstractVehicle;
use Vehicles\BoatVehicle;
use Vehicles\VehicleTypeInterface\AquaticInterface;

class BoatVehicleTest extends TestCase
{
    public function testInstantiation()
    {
        $vehicle = new BoatVehicle('test');
        $this->assertInstanceOf(AbstractVehicle::class, $vehicle, 'Must extend AbstractVehicle');
        $this->assertInstanceOf(AquaticInterface::class, $vehicle, 'Must implement AquaticInterface');
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
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param BoatVehicle $vehicle
     *
     * @return BoatVehicle
     */
    public function testStopWhenNotMoving(BoatVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();

        return $vehicle;
    }

    /**
     * @depends testRefuelWithAcceptedFuelType
     *
     * @param BoatVehicle $vehicle
     *
     * @return BoatVehicle
     */
    public function testSwim(BoatVehicle $vehicle)
    {
        $this->assertEquals(
            'Swim action successful',
            $vehicle->swim()
        );

        return $vehicle;
    }

    /**
     * @depends testSwim
     *
     * @param BoatVehicle $vehicle
     */
    public function testSwimWhenMoving(BoatVehicle $vehicle)
    {
        $this->expectException(AlreadyMovingException::class);
        $vehicle->swim();
    }

    /**
     * @depends testSwim
     *
     * @param BoatVehicle $vehicle
     *
     * @return BoatVehicle
     */
    public function testStop(BoatVehicle $vehicle)
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
     * @param BoatVehicle $vehicle
     */
    public function testStopWhenStopped(BoatVehicle $vehicle)
    {
        $this->expectException(NotMovingException::class);
        $vehicle->stop();
    }

    /**
     * @depends testStop
     *
     * @param BoatVehicle $vehicle
     */
    public function testSwimWithEmptyTank(BoatVehicle $vehicle)
    {
        $this->expectException(NoFuelException::class);
        $vehicle->swim();
    }
}
