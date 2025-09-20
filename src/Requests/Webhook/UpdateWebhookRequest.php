<?php

namespace Chirag\KatanaPhpSdk\Requests\Webhook;

use Chirag\KatanaPhpSdk\Dto\Webhook;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class UpdateWebhookRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected int $id,
        protected array $data
    ) {}

    public function resolveEndpoint(): string
    {
        return "/webhooks/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): Webhook
    {
        return Webhook::fromResponse($response->json());
    }
}
