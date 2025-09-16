<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrderRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListPurchaseOrderRowsRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/purchase_order_rows';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return PurchaseOrderRow::collect($response);
    }
}
