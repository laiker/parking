<?
namespace App;

interface ParkingRepository
{
    public static function create(Parking $object);
    public static function save($parkingId, Parking $object);
    public static function remove($parkingId);
    public static function findById($parkingId);
    public static function getAll();
    public static function getData();
    public static function saveData(array $parkings);
}