<?
namespace App;

abstract class VehicleType
{
    private $vin;
    private $spaceLimit;

    public function __construct($vin)
    {
        $this->vin = $vin;
    }

    public function getVin()
    {
        return $this->vin;
    }

    abstract public function getSpaceLimit();
}