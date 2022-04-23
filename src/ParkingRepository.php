<?
namespace App;

interface ParkingRepository
{
    public function create(Parking $object);
    public function save($parkingId, Parking $object);
    public function remove($parkingId);
    public function findById($parkingId);
    public function getAll();
    public function getData();
    public function saveData(array $parkings);
}