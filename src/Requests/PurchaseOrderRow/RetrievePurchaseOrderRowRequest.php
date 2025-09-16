<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrderRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrievePurchaseOrderRowRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_order_rows/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): PurchaseOrderRow
    {
        return PurchaseOrderRow::fromResponse($response->json());
    }
}
