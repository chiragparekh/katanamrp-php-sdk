<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderOperationRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListManufacturingOrderOperationRowsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/manufacturing_order_operation_rows';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ManufacturingOrderOperationRow::collect($response);
    }
}
