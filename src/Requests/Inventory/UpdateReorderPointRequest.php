<?php

namespace Chirag\KatanaPhpSdk\Requests\Inventory;

use Chirag\KatanaPhpSdk\Dto\ReorderPoint;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateReorderPointRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return '/inventory_reorder_points';
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ReorderPoint
    {
        return ReorderPoint::fromResponse($response->json());
    }
}
