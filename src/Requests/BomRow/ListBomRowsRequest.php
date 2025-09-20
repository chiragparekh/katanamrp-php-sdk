<?php

namespace Chirag\KatanaPhpSdk\Requests\BomRow;

use Chirag\KatanaPhpSdk\Dto\BomRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListBomRowsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/bom_rows';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return BomRow::collect($response);
    }
}
