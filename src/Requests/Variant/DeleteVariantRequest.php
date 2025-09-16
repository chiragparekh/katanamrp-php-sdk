<?php

namespace Chirag\KatanaPhpSdk\Requests\Variant;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteVariantRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/variants/{$this->id}";
    }
}
