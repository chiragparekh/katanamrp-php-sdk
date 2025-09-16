<?php

namespace Chirag\KatanaPhpSdk\Requests\Variant;

use Chirag\KatanaPhpSdk\Dto\Variant;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListVariantsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/variants';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Variant::collect($response);
    }
}
