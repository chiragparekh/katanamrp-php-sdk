<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteManufacturingOrderRecipeRowRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_recipe_rows/{$this->id}";
    }
}
