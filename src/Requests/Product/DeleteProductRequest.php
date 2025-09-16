<?php

namespace Chirag\KatanaPhpSdk\Requests\Product;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteProductRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/products/{$this->id}";
    }
}
