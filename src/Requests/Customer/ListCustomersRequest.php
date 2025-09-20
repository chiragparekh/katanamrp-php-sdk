<?php

namespace Chirag\KatanaPhpSdk\Requests\Customer;

use Chirag\KatanaPhpSdk\Dto\Customer;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListCustomersRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/customers';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Customer::collect($response);
    }
}
