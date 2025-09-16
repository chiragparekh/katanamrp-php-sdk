<?php

namespace Chirag\KatanaPhpSdk\Requests\Material;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteMaterialRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/materials/{$this->id}";
    }
}
