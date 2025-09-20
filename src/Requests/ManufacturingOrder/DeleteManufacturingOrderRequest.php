<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrder;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteManufacturingOrderRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_orders/{$this->id}";
    }
}
