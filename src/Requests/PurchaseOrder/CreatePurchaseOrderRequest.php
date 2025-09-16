<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrder;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrder;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreatePurchaseOrderRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/purchase_orders';
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
