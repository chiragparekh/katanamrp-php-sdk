<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class SalesOrderRow
{
    public function __construct(
        public int $salesOrderId,
        public int $id,
        public float $quantity,
        public int $variantId,
        public int $taxRateId,
        public int $locationId,
        public float $pricePerUnit,
        public ?string $totalDiscount,
        public float $pricePerUnitInBaseCurrency,
        public float $total,
        public float $totalInBaseCurrency,
        public ?float $conversionRate,
        public ?string $conversionDate,
        public string $productAvailability,
        public ?string $productExpectedDate,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
        public ?int $linkedManufacturingOrderId,
        public array $attributes,
        public array $batchTransactions,
        public array $serialNumbers,
        public ?Variant $variant,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            salesOrderId: $data['sales_order_id'],
            id: $data['id'],
            quantity: $data['quantity'],
            variantId: $data['variant_id'],
            taxRateId: $data['tax_rate_id'],
            locationId: $data['location_id'],
            pricePerUnit: $data['price_per_unit'],
            totalDiscount: $data['total_discount'] ?? null,
            pricePerUnitInBaseCurrency: $data['price_per_unit_in_base_currency'],
            total: $data['total'],
            totalInBaseCurrency: $data['total_in_base_currency'],
            conversionRate: $data['conversion_rate'] ?? null,
            conversionDate: $data['conversion_date'] ?? null,
            productAvailability: $data['product_availability'],
            productExpectedDate: $data['product_expected_date'] ?? null,
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            deletedAt: $data['deleted_at'] ?? null,
            linkedManufacturingOrderId: $data['linked_manufacturing_order_id'] ?? null,
            attributes: array_map(
                fn (array $item) => Attribute::fromResponse($item),
                $data['attributes'] ?? []
            ),
            batchTransactions: array_map(
                fn (array $item) => BatchTransaction::fromResponse($item),
                $data['batch_transactions'] ?? []
            ),
            serialNumbers: $data['serial_numbers'] ?? [],
            variant: isset($data['variant']) ? Variant::fromResponse($data['variant']) : null,
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
