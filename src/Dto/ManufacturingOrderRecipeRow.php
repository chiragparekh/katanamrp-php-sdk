<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class ManufacturingOrderRecipeRow
{
    public function __construct(
        public int $id,
        public int $manufacturingOrderId,
        public int $variantId,
        public ?string $notes,
        public float $plannedQuantityPerUnit,
        public ?float $totalActualQuantity,
        public string $ingredientAvailability,
        public ?DateTime $ingredientExpectedDate,
        public array $batchTransactions,
        public ?float $cost,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?DateTime $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            manufacturingOrderId: $data['manufacturing_order_id'],
            variantId: $data['variant_id'],
            notes: $data['notes'] ?? null,
            plannedQuantityPerUnit: $data['planned_quantity_per_unit'],
            totalActualQuantity: $data['total_actual_quantity'] ?? null,
            ingredientAvailability: $data['ingredient_availability'],
            ingredientExpectedDate: isset($data['ingredient_expected_date']) ? new DateTime($data['ingredient_expected_date']) : null,
            batchTransactions: array_map(
                fn (array $item) => BatchTransaction::fromResponse($item),
                $data['batch_transactions'] ?? []
            ),
            cost: $data['cost'] ?? null,
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
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
