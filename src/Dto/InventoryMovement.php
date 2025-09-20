<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class InventoryMovement
{
    public function __construct(
        public int $id,
        public int $variantId,
        public int $locationId,
        public string $resourceType,
        public int $resourceId,
        public ?string $causedByOrderNo,
        public ?int $causedByResourceId,
        public string $movementDate,
        public int $quantityChange,
        public float $balanceAfter,
        public float $valuePerUnit,
        public float $valueInStockAfter,
        public float $averageCostAfter,
        public int $rank,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            variantId: $data['variant_id'],
            locationId: $data['location_id'],
            resourceType: $data['resource_type'],
            resourceId: $data['resource_id'],
            causedByOrderNo: $data['caused_by_order_no'] ?? null,
            causedByResourceId: $data['caused_by_resource_id'] ?? null,
            movementDate: $data['movement_date'],
            quantityChange: $data['quantity_change'],
            balanceAfter: $data['balance_after'],
            valuePerUnit: $data['value_per_unit'],
            valueInStockAfter: $data['value_in_stock_after'],
            averageCostAfter: $data['average_cost_after'],
            rank: $data['rank'],
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
