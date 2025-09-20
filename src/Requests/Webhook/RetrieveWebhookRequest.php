<?php

namespace Chirag\KatanaPhpSdk\Requests\Webhook;

use Chirag\KatanaPhpSdk\Dto\Webhook;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveWebhookRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Webhook
    {
        return Webhook::fromResponse($response->json());
    }
}
