<?php

namespace Chirag\KatanaPhpSdk\Requests\BomRow;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteBomRowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/bom_rows/{$this->id}";
    }
}
