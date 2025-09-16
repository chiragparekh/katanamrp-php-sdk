<?php

namespace Chirag\KatanaPhpSdk\Requests\Variant;

use Chirag\KatanaPhpSdk\Dto\Variant;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateVariantRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        private int $id,
        private array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/variants/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Variant
    {
        return Variant::fromResponse($response->json());
    }
}
