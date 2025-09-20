<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrderRow;

use Chirag\KatanaPhpSdk\Dto\SalesOrderRow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveSalesOrderRowRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_order_rows/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): SalesOrderRow
    {
        return SalesOrderRow::fromResponse($response->json());
    }
}
