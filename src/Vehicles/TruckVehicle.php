<?php

namespace Vehicles;

class TruckVehicle extends CarVehicle
{
    const FUEL_TYPE = 'diesel';

    public function unload(): string
    {
        return 'Cargo unload action successful';
    }
}
