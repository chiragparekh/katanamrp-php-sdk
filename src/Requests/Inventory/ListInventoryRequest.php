<?php

namespace Chirag\KatanaPhpSdk\Requests\Inventory;

use Chirag\KatanaPhpSdk\Dto\Inventory;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListInventoryRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/inventory';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Inventory::collect($response);
    }
}
