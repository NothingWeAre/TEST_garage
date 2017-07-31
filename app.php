<?php
include "lib/loader.php";

use Exceptions\IncorrectFuelTypeException;
use Vehicles\CarVehicle;

$garage = new Garage();

$garage->addVehicle(new CarVehicle('BMW'));

foreach($garage->getVehicles() as $vehicle){
    try{
        $vehicle->refuel('');
    }catch(IncorrectFuelTypeException $exception){
        $exception->getMessage();
    }
}
