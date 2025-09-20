<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrderRow;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteSalesOrderRowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_order_rows/{$this->id}";
    }
}
