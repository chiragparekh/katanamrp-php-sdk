<?php

namespace Chirag\KatanaPhpSdk\Requests\Location;

use Chirag\KatanaPhpSdk\Dto\Location;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListLocationsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/locations';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Location::collect($response);
    }
}
