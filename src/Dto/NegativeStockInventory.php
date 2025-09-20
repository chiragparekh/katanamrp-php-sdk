<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class NegativeStockInventory
{
    public function __construct(
        public int $variantId,
        public int $locationId,
        public string $latestNegativeStockDate,
        public string $name,
        public ?string $sku,
        public ?string $category,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            variantId: $data['variant_id'],
            locationId: $data['location_id'],
            latestNegativeStockDate: $data['latest_negative_stock_date'],
            name: $data['name'],
            sku: $data['sku'] ?? null,
            category: $data['category'] ?? null,
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
