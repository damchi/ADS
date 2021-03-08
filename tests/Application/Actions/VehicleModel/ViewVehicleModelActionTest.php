<?php
declare(strict_types=1);

namespace Tests\Application\Actions\VehicleModel;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\VehicleModel\VehicleModel;
use App\Domain\VehicleModel\VehicleModelNotFoundException;
use App\Domain\VehicleModel\VehicleModelRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class ViewVehicleModelActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $vehicleModel = new VehicleModel();

        $vehicleModelRepositoryProphecy = $this->prophesize(VehicleModelRepository::class);
        $vehicleModelRepositoryProphecy
            ->findOne(1)
            ->willReturn([$vehicleModel])
            ->shouldBeCalledOnce();

        $container->set(VehicleModelRepository::class, $vehicleModelRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/api/vehicle-models/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = [$vehicleModel];
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionThrowsUserNotFoundException()
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

        /** @var Container $container */
        $container = $app->getContainer();

        $vehicleModelRepositoryProphecy = $this->prophesize(VehicleModelRepository::class);
        $vehicleModelRepositoryProphecy
            ->findOne(1)
            ->willThrow(new VehicleModelNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(VehicleModelRepository::class, $vehicleModelRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/api/vehicle-models/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The vehicle model you requested does not exist.');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
