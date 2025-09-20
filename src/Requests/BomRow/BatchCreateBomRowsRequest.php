<?php

namespace Chirag\KatanaPhpSdk\Requests\BomRow;

use Chirag\KatanaPhpSdk\Dto\BomRow;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class BatchCreateBomRowsRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/bom_rows/batch/create';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): array
    {
        return BomRow::collect($response);
    }
}
