<?php

namespace Chirag\KatanaPhpSdk\Requests\Material;

use Chirag\KatanaPhpSdk\Dto\Material;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveMaterialRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/materials/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Material
    {
        return Material::fromResponse($response->json());
    }
}
