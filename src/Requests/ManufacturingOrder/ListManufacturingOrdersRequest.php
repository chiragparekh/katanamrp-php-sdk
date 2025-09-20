<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrder;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListManufacturingOrdersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/manufacturing_orders';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ManufacturingOrder::collect($response);
    }
}
