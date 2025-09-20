<?php

namespace Chirag\KatanaPhpSdk\Requests\Inventory;

use Chirag\KatanaPhpSdk\Dto\NegativeStockInventory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListNegativeStockRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/negative_stock';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return NegativeStockInventory::collect($response);
    }
}
