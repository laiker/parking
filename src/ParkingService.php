<?
namespace App;

class ParkingService
{
    public static function run($action, $params = [])
    {
        if (!method_exists(__CLASS__, $action)) {
            throw new \Exception('this action is unavailable');
        }

        if (!empty($params)) {
            self::$action(...$params);
        } else {
            self::$action();
        }
    }

    public static function createParking($parkingLimit)
    {
        $parking = new Parking($parkingLimit);
        FileParkingRepository::create($parking);
    }

    public static function parkVehicle($parkingId, $vehicleType, $vehicleVin)
    {
        $parking = FileParkingRepository::findById($parkingId);
        $parking->parkVehicle($vehicleType, $vehicleVin);
        FileParkingRepository::save($parkingId, $parking);
    }

    public static function unparkVehicle($parkingId, $vehicleId)
    {
        $parking = FileParkingRepository::findById($parkingId);
        $parking->unparkVehicle($vehicleId);
        FileParkingRepository::save($parkingId, $parking);
    }

    public static function getAllParkings()
    {
        print_r(FileParkingRepository::getAll());
    }

    public static function removeParking($parkingId)
    {
        FileParkingRepository::remove($parkingId);
    }  
}