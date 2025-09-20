<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class ManufacturingOrder
{
    public function __construct(
        public int $id,
        public string $status,
        public string $orderNo,
        public int $variantId,
        public float $plannedQuantity,
        public ?float $actualQuantity,
        public array $batchTransactions,
        public int $locationId,
        public string $orderCreatedDate,
        public ?string $doneDate,
        public string $productionDeadlineDate,
        public string $additionalInfo,
        public bool $isLinkedToSalesOrder,
        public string $ingredientAvailability,
        public float $totalCost,
        public float $totalActualTime,
        public float $totalPlannedTime,
        public ?int $salesOrderId,
        public ?int $salesOrderRowId,
        public ?string $salesOrderDeliveryDeadline,
        public ?float $materialCost,
        public string $createdAt,
        public string $updatedAt,
        public ?float $subassembliesCost,
        public ?float $operationsCost,
        public ?string $deletedAt,
        public array $serialNumbers,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            status: $data['status'],
            orderNo: $data['order_no'],
            variantId: $data['variant_id'],
            plannedQuantity: $data['planned_quantity'],
            actualQuantity: $data['actual_quantity'] ?? null,
            batchTransactions: $data['batch_transactions'] ?? [],
            locationId: $data['location_id'],
            orderCreatedDate: $data['order_created_date'],
            doneDate: $data['done_date'] ?? null,
            productionDeadlineDate: $data['production_deadline_date'],
            additionalInfo: $data['additional_info'],
            isLinkedToSalesOrder: $data['is_linked_to_sales_order'],
            ingredientAvailability: $data['ingredient_availability'],
            totalCost: $data['total_cost'],
            totalActualTime: $data['total_actual_time'],
            totalPlannedTime: $data['total_planned_time'],
            salesOrderId: $data['sales_order_id'] ?? null,
            salesOrderRowId: $data['sales_order_row_id'] ?? null,
            salesOrderDeliveryDeadline: $data['sales_order_delivery_deadline'] ?? null,
            materialCost: $data['material_cost'] ?? null,
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            subassembliesCost: $data['subassemblies_cost'] ?? null,
            operationsCost: $data['operations_cost'] ?? null,
            deletedAt: $data['deleted_at'] ?? null,
            serialNumbers: array_map(
                fn (array $item) => SerialNumber::fromResponse($item),
                $data['serial_numbers'] ?? []
            ),
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
