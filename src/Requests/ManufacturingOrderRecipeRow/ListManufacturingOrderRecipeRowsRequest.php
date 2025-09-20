<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderRecipeRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListManufacturingOrderRecipeRowsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/manufacturing_order_recipe_rows';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ManufacturingOrderRecipeRow::collect($response);
    }
}
