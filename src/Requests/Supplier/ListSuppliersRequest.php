<?php

namespace Chirag\KatanaPhpSdk\Requests\Supplier;

use Chirag\KatanaPhpSdk\Dto\Supplier;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListSuppliersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/suppliers';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Supplier::collect($response);
    }
}
