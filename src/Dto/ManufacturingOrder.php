<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
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
        public DateTime $orderCreatedDate,
        public ?DateTime $doneDate,
        public DateTime $productionDeadlineDate,
        public string $additionalInfo,
        public bool $isLinkedToSalesOrder,
        public string $ingredientAvailability,
        public float $totalCost,
        public float $totalActualTime,
        public float $totalPlannedTime,
        public ?int $salesOrderId,
        public ?int $salesOrderRowId,
        public ?DateTime $salesOrderDeliveryDeadline,
        public ?float $materialCost,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?float $subassembliesCost,
        public ?float $operationsCost,
        public ?DateTime $deletedAt,
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
            orderCreatedDate: new DateTime($data['order_created_date']),
            doneDate: isset($data['done_date']) ? new DateTime($data['done_date']) : null,
            productionDeadlineDate: new DateTime($data['production_deadline_date']),
            additionalInfo: $data['additional_info'],
            isLinkedToSalesOrder: $data['is_linked_to_sales_order'],
            ingredientAvailability: $data['ingredient_availability'],
            totalCost: $data['total_cost'],
            totalActualTime: $data['total_actual_time'],
            totalPlannedTime: $data['total_planned_time'],
            salesOrderId: $data['sales_order_id'] ?? null,
            salesOrderRowId: $data['sales_order_row_id'] ?? null,
            salesOrderDeliveryDeadline: isset($data['sales_order_delivery_deadline']) ? new DateTime($data['sales_order_delivery_deadline']) : null,
            materialCost: $data['material_cost'] ?? null,
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            subassembliesCost: $data['subassemblies_cost'] ?? null,
            operationsCost: $data['operations_cost'] ?? null,
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
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
