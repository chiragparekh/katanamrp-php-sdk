<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeletePurchaseOrderRowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_order_rows/{$this->id}";
    }
}
