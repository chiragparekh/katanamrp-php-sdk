<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class PurchaseOrderRow
{
    public function __construct(
        public int $id,
        public float $quantity,
        public int $variantId,
        public ?int $taxRateId,
        public float $pricePerUnit,
        public ?float $pricePerUnitInBaseCurrency,
        public ?float $purchaseUomConversionRate,
        public ?string $purchaseUom,
        public float $total,
        public float $totalInBaseCurrency,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
        public string $currency,
        public ?float $conversionRate,
        public ?string $conversionDate,
        public ?string $receivedDate,
        public ?string $arrivalDate,
        public int $purchaseOrderId,
        public ?float $landedCost,
        public ?int $groupId,
        public array $batchTransactions,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            quantity: $data['quantity'],
            variantId: $data['variant_id'],
            taxRateId: $data['tax_rate_id'] ?? null,
            pricePerUnit: $data['price_per_unit'],
            pricePerUnitInBaseCurrency: $data['price_per_unit_in_base_currency'] ?? null,
            purchaseUomConversionRate: $data['purchase_uom_conversion_rate'] ?? null,
            purchaseUom: $data['purchase_uom'] ?? null,
            total: $data['total'],
            totalInBaseCurrency: $data['total_in_base_currency'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            deletedAt: $data['deleted_at'] ?? null,
            currency: $data['currency'],
            conversionRate: $data['conversion_rate'] ?? null,
            conversionDate: $data['conversion_date'] ?? null,
            receivedDate: $data['received_date'] ?? null,
            arrivalDate: $data['arrival_date'] ?? null,
            purchaseOrderId: $data['purchase_order_id'],
            landedCost: $data['landed_cost'] ?? null,
            groupId: $data['group_id'] ?? null,
            batchTransactions: $data['batch_transactions'] ?? [],
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
