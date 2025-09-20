<?php

namespace Chirag\KatanaPhpSdk\Requests\BomRow;

use Chirag\KatanaPhpSdk\Dto\BomRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateBomRowRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected string $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/bom_rows/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): BomRow
    {
        return BomRow::fromResponse($response->json());
    }
}
