<?
namespace App;

final class FileParkingRepository implements ParkingRepository
{
    private static $filename = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'parkings.txt';
    
    public static function create(Parking $object)
    {
        $arParkings = self::getData();
        $arParkings[] = $object;
        self::saveData($arParkings);
    }

    public static function save($parkingId, Parking $object)
    {
        $arParkings = self::getData();

        if (!isset($arParkings[$parkingId])) {
            throw new \Exception("Parking does not exist");
        }

        $arParkings = self::getData();
        $arParkings[$parkingId] = $object;
        self::saveData($arParkings);
    }

    public static function remove($parkingId)
    {
        $arParkings = self::getData();
        unset($arParkings[$parkingId]);
        self::saveData($arParkings);
    }

    public static function findById($parkingId)
    {
        $arParkings = self::getData();

        if (!isset($arParkings[$parkingId])) {
            throw new \Exception("Parking does not exist");
        }

        return $arParkings[$parkingId];
    }

    public static function getAll()
    {
        return self::getData();
    }

    public static function getData()
    {
        return \file_exists(self::$filename)
            ? \unserialize(file_get_contents(self::$filename))
            : [];
    }

    public static function saveData(array $parkings)
    {
        if (!\file_exists( self::$filename)) {
            return \touch(self::$filename);
        }

        \file_put_contents( $_SERVER["DOCUMENT_ROOT"] . self::$filename, \serialize($parkings));
    }


}