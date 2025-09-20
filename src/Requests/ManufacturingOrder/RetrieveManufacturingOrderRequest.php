<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrder;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveManufacturingOrderRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_orders/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrder
    {
        return ManufacturingOrder::fromResponse($response->json());
    }
}
