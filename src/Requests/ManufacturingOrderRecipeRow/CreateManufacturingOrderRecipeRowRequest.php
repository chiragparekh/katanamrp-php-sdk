<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderRecipeRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateManufacturingOrderRecipeRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/manufacturing_order_recipe_rows';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrderRecipeRow
    {
        return ManufacturingOrderRecipeRow::fromResponse($response->json());
    }
}
