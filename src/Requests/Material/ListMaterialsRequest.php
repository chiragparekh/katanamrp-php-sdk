<?php

namespace Chirag\KatanaPhpSdk\Requests\Material;

use Chirag\KatanaPhpSdk\Dto\Material;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListMaterialsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/materials';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Material::collect($response);
    }
}
