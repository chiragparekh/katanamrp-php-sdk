<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrder;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListPurchaseOrdersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/purchase_orders';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return PurchaseOrder::collect($response);
    }
}
