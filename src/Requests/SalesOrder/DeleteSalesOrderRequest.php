<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrder;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteSalesOrderRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_orders/{$this->id}";
    }
}
