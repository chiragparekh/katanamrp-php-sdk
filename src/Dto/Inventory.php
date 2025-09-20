<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Inventory
{
    public function __construct(
        public int $variantId,
        public int $locationId,
        public float $reorderPoint,
        public float $averageCost,
        public float $valueInStock,
        public float $quantityInStock,
        public float $quantityCommitted,
        public float $quantityExpected,
        public float $quantityMissingOrExcess,
        public ?float $quantityPotential,
        public ?Variant $variant,
        public ?Location $location,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            variantId: $data['variant_id'],
            locationId: $data['location_id'],
            reorderPoint: (float) $data['reorder_point'],
            averageCost: (float) $data['average_cost'],
            valueInStock: (float) $data['value_in_stock'],
            quantityInStock: (float) $data['quantity_in_stock'],
            quantityCommitted: (float) $data['quantity_committed'],
            quantityExpected: (float) $data['quantity_expected'],
            quantityMissingOrExcess: (float) $data['quantity_missing_or_excess'],
            quantityPotential: (float) $data['quantity_potential'] ?? null,
            variant: isset($data['variant']) ? Variant::fromResponse($data['variant']) : null,
            location: isset($data['location']) ? Location::fromResponse($data['location']) : null,
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
