<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
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
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?DateTime $deletedAt,
        public string $currency,
        public ?float $conversionRate,
        public ?DateTime $conversionDate,
        public ?DateTime $receivedDate,
        public ?DateTime $arrivalDate,
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
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
            currency: $data['currency'],
            conversionRate: $data['conversion_rate'] ?? null,
            conversionDate: isset($data['conversion_date']) ? new DateTime($data['conversion_date']) : null,
            receivedDate: isset($data['received_date']) ? new DateTime($data['received_date']) : null,
            arrivalDate: isset($data['arrival_date']) ? new DateTime($data['arrival_date']) : null,
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
