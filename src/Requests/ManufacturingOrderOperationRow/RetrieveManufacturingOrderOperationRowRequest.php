<?php

namespace Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderOperationRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveManufacturingOrderOperationRowRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/manufacturing_order_operation_rows/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): ManufacturingOrderOperationRow
    {
        return ManufacturingOrderOperationRow::fromResponse($response->json());
    }
}
