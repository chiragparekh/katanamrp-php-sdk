<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderRecipeRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveManufacturingOrderRecipeRowRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_recipe_rows/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrderRecipeRow
    {
        return ManufacturingOrderRecipeRow::fromResponse($response->json());
    }
}
