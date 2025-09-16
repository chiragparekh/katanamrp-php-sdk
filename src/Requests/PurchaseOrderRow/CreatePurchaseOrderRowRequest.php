<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrderRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreatePurchaseOrderRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/purchase_order_rows';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): PurchaseOrderRow
    {
        return PurchaseOrderRow::fromResponse($response->json());
    }
}
