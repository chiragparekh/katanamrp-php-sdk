<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrder;

use Chirag\KatanaPhpSdk\Dto\SalesOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListSalesOrdersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/sales_orders';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return SalesOrder::collect($response);
    }
}
