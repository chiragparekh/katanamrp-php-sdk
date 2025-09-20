<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrder;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrder;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateManufacturingOrderRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected int $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_orders/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrder
    {
        return ManufacturingOrder::fromResponse($response->json());
    }
}
