<?php

namespace Chirag\KatanaPhpSdk\Requests\Product;

use Chirag\KatanaPhpSdk\Dto\Product;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveProductRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/products/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Product
    {
        return Product::fromResponse($response->json());
    }
}
