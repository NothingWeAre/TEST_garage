<?php
include "vendor/autoload.php";

use Vehicles\BicycleVehicle;
use Vehicles\BoatVehicle;
use Vehicles\CarVehicle;
use Vehicles\HelicopterVehicle;
use Vehicles\SpaceShuttleVehicle;
use Vehicles\TruckVehicle;
use Vehicles\VehicleTypeInterface\AerialInterface;
use Vehicles\VehicleTypeInterface\AquaticInterface;
use Vehicles\VehicleTypeInterface\HasEntertainmentInterface;
use Vehicles\VehicleTypeInterface\RequireFuelInterface;
use Vehicles\VehicleTypeInterface\TerrainInterface;

$garage = new Garage();

//populate garage
$garage
    ->addVehicle(new CarVehicle('BMW'))
    ->addVehicle(new HelicopterVehicle('helicopter 1'))
    ->addVehicle(new BoatVehicle('Boat 1'))
    ->addVehicle(new TruckVehicle('Caterpilar 1'))
    ->addVehicle(new BicycleVehicle('Cannondale'))
    ->addVehicle(new SpaceShuttleVehicle('Space shuttle 1'))
;

//try riding each vehicle
$i = 1;
foreach($garage->getVehicles() as $vehicle){

    echo sprintf("Vehicle #%d: %s \n", $i, $vehicle->getName());

    if($vehicle instanceof RequireFuelInterface && !$vehicle->getFuelTank()->hasFuel()){
        echo $vehicle->getFuelTank()->refuel($vehicle->getFuelTank()->getAcceptedFuelType())."\n";
    }

    if($vehicle instanceof HasEntertainmentInterface){
        echo $vehicle->musicOn()."\n";
    }

    if($vehicle instanceof AerialInterface){
        echo $vehicle->takeOff()."\n";
        echo $vehicle->fly()."\n";
        echo $vehicle->land()."\n";
    }
    if($vehicle instanceof TerrainInterface){
        echo $vehicle->drive()."\n";
        echo $vehicle->stop()."\n";

        if($vehicle instanceof TruckVehicle){
            echo $vehicle->unload()."\n";
        }
    }

    if($vehicle instanceof AquaticInterface){
        echo $vehicle->swim()."\n";
        echo $vehicle->stop()."\n";
    }

    echo "---Trying vehicle complete--- \n\n\n";
    $i++;
}
