<?php

namespace Chirag\KatanaPhpSdk\Requests\Customer;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteCustomerRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/customers/{$this->id}";
    }
}
