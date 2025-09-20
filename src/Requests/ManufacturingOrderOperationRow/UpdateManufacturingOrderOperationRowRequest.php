<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderOperationRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateManufacturingOrderOperationRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected int $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_operation_rows/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrderOperationRow
    {
        return ManufacturingOrderOperationRow::fromResponse($response->json());
    }
}
