<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrder;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeletePurchaseOrderRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_orders/{$this->id}";
    }
}
