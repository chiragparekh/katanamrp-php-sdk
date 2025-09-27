<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
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
        public DateTime $createdAt,
        public DateTime $updatedAt,
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
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
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
