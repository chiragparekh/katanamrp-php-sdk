<?php

namespace Chirag\KatanaPhpSdk\Requests\Webhook;

use Chirag\KatanaPhpSdk\Dto\Webhook;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListWebhooksRequest extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/webhooks';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Webhook::collect($response);
    }
}
