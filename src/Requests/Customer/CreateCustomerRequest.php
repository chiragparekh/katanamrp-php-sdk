<?php

namespace Chirag\KatanaPhpSdk\Requests\Customer;

use Chirag\KatanaPhpSdk\Dto\Customer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateCustomerRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/customers';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Customer
    {
        return Customer::fromResponse($response->json());
    }
}
