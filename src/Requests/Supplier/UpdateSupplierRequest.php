<?php

namespace Chirag\KatanaPhpSdk\Requests\Supplier;

use Chirag\KatanaPhpSdk\Dto\Supplier;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateSupplierRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        private int $id,
        private array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/suppliers/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Supplier
    {
        return Supplier::fromResponse($response->json());
    }
}
