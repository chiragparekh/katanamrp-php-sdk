<?php

namespace Chirag\KatanaPhpSdk\Requests\Product;

use Chirag\KatanaPhpSdk\Dto\Product;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListProductsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/products';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Product::collect($response);
    }
}
