<?
$autoloadPath = __DIR__ . '/vendor/autoload.php';
require_once $autoloadPath;

use App\ParkingService;
use GuzzleHttp\Psr7\Response;

try {
    $parkingService = new ParkingService();
    $parkingService->run($argv[1], array_slice($argv, 2));
} catch (\Exception $e) {
    $response = new Response(502, [],  $e->getMessage(), '1.1');
    echo  $e->getMessage();
}