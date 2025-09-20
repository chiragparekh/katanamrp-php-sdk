<?php

namespace Chirag\KatanaPhpSdk\Requests\Inventory;

use Chirag\KatanaPhpSdk\Dto\SafetyStock;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateSafetyStockRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/inventory_safety_stock';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): SafetyStock
    {
        return SafetyStock::fromResponse($response->json());
    }
}
