<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class SafetyStock
{
    public function __construct(
        public int $variantId,
        public int $locationId,
        public int $value,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            variantId: $data['variant_id'],
            locationId: $data['location_id'],
            value: $data['value'],
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
