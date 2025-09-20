<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrder;

use Chirag\KatanaPhpSdk\Dto\ReturnableItem;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetReturnableItemsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_orders/{$this->id}/returnable_items";
    }

    public function createDtoFromResponse(Response $response): array
    {
        return ReturnableItem::collect($response);
    }
}
