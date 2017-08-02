<?php

namespace Vehicles\VehicleTypeInterface;


interface TerrainInterface
{
    function drive(): string;

    function stop(): string;
}
