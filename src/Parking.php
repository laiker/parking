<?
namespace App;
use App\VehicleType;
use App\Vehicles\Auto;
use App\Vehicles\Moto;
use App\Vehicles\Track;

final class Parking
{
    private $parkingLimit;
    private $vehicles;

    function __construct($parkingLimit)
    {
        $this->parkingLimit = $parkingLimit;
    }

    function parkVehicle($vehicleType, $vehicleVin)
    {
        $vehicleClass = 'App\\Vehicles\\'  . $vehicleType;
        
        if (!\class_exists($vehicleClass)) {
            throw new \Exception("vehicle type does not exist");
        }

        $vehicle = new $vehicleClass($vehicleVin);
        $this->canVehiclePark($vehicle);
        $this->vehicles[] = $vehicle;
    }

    function unparkVehicle($vehicleId)
    {
        if (!isset($this->vehicles[$vehicleId])) {
            throw new \Exception("vehicle does not exist");
        }

        unset($this->vehicles[$vehicleId]);
    }

    function canVehiclePark(VehicleType $vehicle)
    {
        if (!$this->isSpaceEnough($vehicle->getSpaceLimit())) {
            throw new \Exception("not enough space to park vehicle");
        }
        
        if (!$this->isVinUnique($vehicle->getVin())) {
            throw new \Exception("vin number already exists");
        }
    }

    function isSpaceEnough($vehicleSpaceLimit)
    {
        return $this->getParkingLoad() + $vehicleSpaceLimit <= $this->parkingLimit;
    }

    function isVinUnique($vin)
    {
        if (!$this->vehicles) {
            return true;
        }

        foreach ($this->vehicles as $vehicle) {
            if ($vehicle->getVin() === $vin) {
                return false;
            }
        }

        return true;
    }

    function getParkingLoad() {
        if (!$this->vehicles) {
            return 0;
        }

        return \array_reduce($this->vehicles, function($acc, $vehicle){
            return $acc + $vehicle->getSpaceLimit();
        }, 0);
    }
}