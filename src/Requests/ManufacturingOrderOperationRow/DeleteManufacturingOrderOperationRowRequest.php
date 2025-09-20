<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteManufacturingOrderOperationRowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_operation_rows/{$this->id}";
    }
}
