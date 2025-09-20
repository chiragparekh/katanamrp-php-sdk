<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Webhook
{
    public function __construct(
        public int $id,
        public string $url,
        public string $token,
        public bool $enabled,
        public ?string $description,
        public array $subscribedEvents,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            url: $data['url'],
            token: $data['token'],
            enabled: $data['enabled'],
            description: $data['description'] ?? null,
            subscribedEvents: $data['subscribed_events'] ?? [],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json('data')
        );
    }
}
