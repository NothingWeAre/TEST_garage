<?php
include "vendor/autoload.php";

use Vehicles\BoatVehicle;
use Vehicles\CarVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\TruckVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;
use Vehicles\VehicleTypeInterface\TerrainInterface;

$garage = new Garage();

//populate garage
$garage
    ->addVehicle(new CarVehicle('BMW'))
    ->addVehicle(new HelicopterVehicle('helicopter 1'))
    ->addVehicle(new BoatVehicle('Boat 1'))
    ->addVehicle(new TruckVehicle('Caterpilar 1'))
;

//try riding each vehicle
foreach($garage->getVehicles() as $vehicle){
    if(!$vehicle->hasFuel()){
        $vehicle->refuel($vehicle->getAcceptedFuelType());
    }

    if($vehicle instanceof AerialInterface){
        $vehicle->takeOff();
        $vehicle->fly();
        $vehicle->land();
    }
    if($vehicle instanceof TerrainInterface){
        $vehicle->drive();
    }
}
