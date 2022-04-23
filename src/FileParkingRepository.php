<?
namespace App;

final class FileParkingRepository implements ParkingRepository
{
    public $filename = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parkings.txt';

    public function create(Parking $object)
    {
        $arParkings = $this->getData();
        $arParkings[] = $object;
        $this->saveData($arParkings);
    }

    public function save($parkingId, Parking $object)
    {
        $arParkings = $this->getData();

        if (!isset($arParkings[$parkingId])) {
            throw new \Exception("Parking does not exist");
        }

        $arParkings = $this->getData();
        $arParkings[$parkingId] = $object;
        $this->saveData($arParkings);
    }

    public function remove($parkingId)
    {
        $arParkings = $this->getData();
        unset($arParkings[$parkingId]);
        $this->saveData($arParkings);
    }

    public function findById($parkingId)
    {
        $arParkings = $this->getData();

        if (!isset($arParkings[$parkingId])) {
            throw new \Exception("Parking does not exist");
        }

        return $arParkings[$parkingId];
    }

    public function getAll()
    {
        return $this->getData();
    }

    public function getData()
    {
        return \file_exists($this->filename)
            ? \unserialize(file_get_contents($this->filename))
            : [];
    }

    public function saveData(array $parkings)
    {
        \file_put_contents($this->filename, \serialize($parkings));
    }


}