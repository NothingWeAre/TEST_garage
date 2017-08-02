<?php

namespace Vehicles\VehicleTypeInterface;

interface AerialInterface
{
    function takeOff(): string;

    function fly(): string;

    function land(): string;
}
