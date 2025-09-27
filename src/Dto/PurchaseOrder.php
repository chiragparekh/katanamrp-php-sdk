<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class PurchaseOrder
{
    public function __construct(
        public int $id,
        public string $status,
        public string $orderNo,
        public string $entityType,
        public ?int $defaultGroupId,
        public int $supplierId,
        public string $currency,
        public DateTime $expectedArrivalDate,
        public DateTime $orderCreatedDate,
        public ?string $additionalInfo,
        public int $locationId,
        public ?string $ingredientAvailability,
        public ?DateTime $ingredientExpectedDate,
        public ?int $trackingLocationId,
        public float $total,
        public float $totalInBaseCurrency,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?DateTime $deletedAt,
        public string $billingStatus,
        public string $lastDocumentStatus,
        public array $purchaseOrderRows,
        public ?Supplier $supplier,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            status: $data['status'],
            orderNo: $data['order_no'],
            entityType: $data['entity_type'],
            defaultGroupId: $data['default_group_id'] ?? null,
            supplierId: $data['supplier_id'],
            currency: $data['currency'],
            expectedArrivalDate: new DateTime($data['expected_arrival_date']),
            orderCreatedDate: new DateTime($data['order_created_date']),
            additionalInfo: $data['additional_info'] ?? null,
            locationId: $data['location_id'],
            ingredientAvailability: $data['ingredient_availability'] ?? null,
            ingredientExpectedDate: isset($data['ingredient_expected_date']) ? new DateTime($data['ingredient_expected_date']) : null,
            trackingLocationId: $data['tracking_location_id'] ?? null,
            total: $data['total'],
            totalInBaseCurrency: $data['total_in_base_currency'],
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
            billingStatus: $data['billing_status'],
            lastDocumentStatus: $data['last_document_status'],
            purchaseOrderRows: array_map(
                fn (array $item) => PurchaseOrderRow::fromResponse($item),
                $data['purchase_order_rows'] ?? []
            ),
            supplier: isset($data['supplier']) ? Supplier::fromResponse($data['supplier']) : null,
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
