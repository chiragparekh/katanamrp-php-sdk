<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrderRow;

use Chirag\KatanaPhpSdk\Dto\SalesOrderRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateSalesOrderRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected int $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/sales_order_rows/{$this->id}";
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
