<?php

namespace Chirag\KatanaPhpSdk\Requests\Variant;

use Chirag\KatanaPhpSdk\Dto\Variant;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveVariantRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/variants/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Variant
    {
        return Variant::fromResponse($response->json());
    }
}
