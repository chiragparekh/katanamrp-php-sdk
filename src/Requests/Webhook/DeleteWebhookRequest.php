<?php

namespace Chirag\KatanaPhpSdk\Requests\Webhook;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteWebhookRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->id}";
    }
}
