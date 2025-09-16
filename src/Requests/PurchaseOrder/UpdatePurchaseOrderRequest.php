<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrder;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrder;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdatePurchaseOrderRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        private int $id,
        private array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_orders/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): PurchaseOrder
    {
        return PurchaseOrder::fromResponse($response->json());
    }
}
