<?
namespace App;

class ParkingService
{
    public $parkingRepository;

    public function __construct() {
        $this->parkingRepository = new FileParkingRepository();
    }
    
    public function run($action, $params = [])
    {
        if (!method_exists(__CLASS__, $action)) {
            throw new \Exception('this action is unavailable');
        }

        if (!empty($params)) {
            $this->$action(...$params);
        } else {
            $this->$action();
        }
    }

    public function createParking($parkingLimit)
    {
        $parking = new Parking($parkingLimit);
        $this->parkingRepository->create($parking);
    }

    public function parkVehicle($parkingId, $vehicleType, $vehicleVin)
    {
        $parking = $this->parkingRepository->findById($parkingId);
        $parking->parkVehicle($vehicleType, $vehicleVin);
        $this->parkingRepository->save($parkingId, $parking);
    }

    public function unparkVehicle($parkingId, $vehicleId)
    {
        $parking = $this->parkingRepository->findById($parkingId);
        $parking->unparkVehicle($vehicleId);
        $this->parkingRepository->save($parkingId, $parking);
    }

    public function getAllParkings()
    {
        print_r($this->parkingRepository->getAll());
    }

    public function removeParking($parkingId)
    {
        $this->parkingRepository->remove($parkingId);
    }  
}