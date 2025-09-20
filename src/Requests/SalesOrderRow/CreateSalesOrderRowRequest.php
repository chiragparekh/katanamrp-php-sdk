<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrderRow;

use Chirag\KatanaPhpSdk\Dto\SalesOrderRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateSalesOrderRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/sales_order_rows';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): SalesOrderRow
    {
        return SalesOrderRow::fromResponse($response->json());
    }
}
