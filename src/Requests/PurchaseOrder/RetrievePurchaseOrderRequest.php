<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrder;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrder;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrievePurchaseOrderRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_orders/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): PurchaseOrder
    {
        return PurchaseOrder::fromResponse($response->json());
    }
}
