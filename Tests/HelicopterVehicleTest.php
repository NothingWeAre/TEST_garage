<?php

use PHPUnit\Framework\TestCase;

class HelicopterVehicleTest extends TestCase
{
    public function testCheckAcceptedFuelType()
    {
        $this->assertEquals(
            'AvGas',
            (new \Vehicles\HelicopterVehicle('test'))->getAcceptedFuelType()
        );
    }
}
