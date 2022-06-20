<?
namespace App\Vehicles;
use App\VehicleType;
use App\Vehicle;

final class Moto extends VehicleType implements Vehicle
{
    public function getSpaceLimit() {
        return 0.5;
    }
}