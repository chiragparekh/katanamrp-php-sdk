<?php

namespace Chirag\KatanaPhpSdk\Requests\Supplier;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteSupplierRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/suppliers/{$this->id}";
    }
}
