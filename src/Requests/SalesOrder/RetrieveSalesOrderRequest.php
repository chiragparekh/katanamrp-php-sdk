<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrder;

use Chirag\KatanaPhpSdk\Dto\SalesOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveSalesOrderRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_orders/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): SalesOrder
    {
        return SalesOrder::fromResponse($response->json());
    }
}
