<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrderRow;

use Chirag\KatanaPhpSdk\Dto\SalesOrderRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListSalesOrderRowsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/sales_order_rows';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return SalesOrderRow::collect($response);
    }
}
