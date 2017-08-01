<?php
include "lib/loader.php";

use Vehicles\BoatVehicle;
use Vehicles\CarVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\TruckVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;

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
        $vehicle->fly();
    }
    if($vehicle instanceof AerialInterface){
        $vehicle->
        $vehicle->fly();
    }
}
