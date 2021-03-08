<?php
declare(strict_types=1);

use App\Application\Actions\Vehicle\AddVehicleAction;
use App\Application\Actions\Vehicle\ListVehiclesAction;
use App\Application\Actions\Vehicle\RemoveVehicleAction;
use App\Application\Actions\Vehicle\ViewVehiclesAction;
use App\Application\Actions\VehicleMake\AddVehicleMakeAction;
use App\Application\Actions\VehicleMake\ListVehicleMakesAction;
use App\Application\Actions\VehicleMake\RemoveVehicleMakeAction;
use App\Application\Actions\VehicleMake\UpdateVehicleMakeAction;
use App\Application\Actions\VehicleMake\ViewVehicleMakesAction;
use App\Application\Actions\VehicleModel\ListVehicleModelsAction;
use App\Application\Actions\VehicleModel\ViewVehicleModelsAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello candidate! Good luck for the test and happy coding =P');
        return $response;
    });

    $app->group('/api', function (Group $group) {
        $group->get('/vehicle-makes', ListVehicleMakesAction::class);
        $group->get('/vehicle-models', ListVehicleModelsAction::class);
        $group->post('/vehicle-makes-update/{id}', UpdateVehicleMakeAction::class);
        $group->post('/vehicle-makes-add', AddVehicleMakeAction::class);
        $group->delete('/vehicle-makes-remove/{id}', RemoveVehicleMakeAction::class);
        $group->get('/vehicles', ListVehiclesAction::class);
        $group->post('/vehicles-add', AddVehicleAction::class);
        $group->delete('/vehicles-remove/{id}', RemoveVehicleAction::class);

        $group->get('/vehicles/{id}', ViewVehiclesAction::class);
        $group->get('/vehicle-models/{id}', ViewVehicleModelsAction::class);
        $group->get('/vehicle-makes/{id}', ViewVehicleMakesAction::class);



    });

};
