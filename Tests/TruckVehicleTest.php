<?php
use Vehicles\AbstractVehicle;
use Vehicles\TruckVehicle;

class TruckVehicleTest extends CarVehicleTest
{
    public function testInstantiation(AbstractVehicle $vehicle = null)
    {
        $vehicle = new TruckVehicle('test');
        return parent::testInstantiation($vehicle);
    }

    /**
     * @depends testInstantiation
     *
     * @param TruckVehicle $vehicle
     */
    public function testCargoUnload(TruckVehicle $vehicle)
    {
        $this->assertEquals(
            'Cargo unload action successful',
            $vehicle->unload()
        );
    }
}
