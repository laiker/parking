<?
namespace App\Vehicles;
use App\VehicleType;
use App\Vehicle;

final class Truck extends VehicleType implements Vehicle
{
    public function getSpaceLimit() {
        return 2;
    }
}