<?php

namespace Chirag\KatanaPhpSdk\Requests\InventoryMovement;

use Chirag\KatanaPhpSdk\Dto\InventoryMovement;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListInventoryMovementsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/inventory_movements';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return InventoryMovement::collect($response);
    }
}
