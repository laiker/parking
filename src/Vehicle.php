<?
namespace App;

interface Vehicle
{
    public function __construct($vin);
    public function getVin();
    public function getSpaceLimit();
}