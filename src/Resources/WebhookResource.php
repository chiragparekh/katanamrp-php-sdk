<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Webhook;
use Chirag\KatanaPhpSdk\Requests\Webhook\CreateWebhookRequest;
use Chirag\KatanaPhpSdk\Requests\Webhook\DeleteWebhookRequest;
use Chirag\KatanaPhpSdk\Requests\Webhook\ListWebhooksRequest;
use Chirag\KatanaPhpSdk\Requests\Webhook\RetrieveWebhookRequest;
use Chirag\KatanaPhpSdk\Requests\Webhook\UpdateWebhookRequest;
use Saloon\Http\BaseResource;

class WebhookResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListWebhooksRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): Webhook
    {
        $request = new RetrieveWebhookRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): Webhook
    {
        $request = new CreateWebhookRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Webhook
    {
        $request = new UpdateWebhookRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteWebhookRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
