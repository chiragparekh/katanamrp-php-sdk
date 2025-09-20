<?php

namespace Chirag\KatanaPhpSdk\Requests\SalesOrder;

use Chirag\KatanaPhpSdk\Dto\SalesOrder;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateSalesOrderRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/sales_orders';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): SalesOrder
    {
        return SalesOrder::fromResponse($response->json());
    }
}
