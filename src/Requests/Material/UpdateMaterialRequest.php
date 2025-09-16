<?php

namespace Chirag\KatanaPhpSdk\Requests\Material;

use Chirag\KatanaPhpSdk\Dto\Material;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateMaterialRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        private int $id,
        private array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/materials/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Material
    {
        return Material::fromResponse($response->json());
    }
}
