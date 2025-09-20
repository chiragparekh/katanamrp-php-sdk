<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderRecipeRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateManufacturingOrderRecipeRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected int $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_recipe_rows/{$this->id}";
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
