<?
namespace App\Vehicles;
use App\VehicleType;
use App\Vehicle;

final class Auto extends VehicleType implements Vehicle
{
    public function getSpaceLimit() {
        return 1;
    }
}