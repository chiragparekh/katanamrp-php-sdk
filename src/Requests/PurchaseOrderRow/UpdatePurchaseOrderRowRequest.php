<?php

namespace Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrderRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdatePurchaseOrderRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        private int $id,
        private array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/purchase_order_rows/{$this->id}";
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
