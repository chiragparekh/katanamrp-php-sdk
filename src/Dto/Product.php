<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class Product
{
    public function __construct(
        public int $id,
        public string $name,
        public string $uom,
        public ?string $categoryName,
        public bool $isProducible,
        public ?int $defaultSupplierId,
        public bool $isSellable,
        public bool $isPurchasable,
        public bool $isAutoAssembly,
        public string $type,
        public ?string $purchaseUom,
        public ?float $purchaseUomConversionRate,
        public bool $batchTracked,
        public bool $operationsInSequence,
        public bool $serialTracked,
        public ?DateTime $archivedAt,
        public array $variants,
        public array $configs,
        public ?string $additionalInfo,
        public ?int $customFieldCollectionId,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?Supplier $supplier,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            uom: $data['uom'],
            categoryName: $data['category_name'] ?? null,
            isProducible: $data['is_producible'],
            defaultSupplierId: $data['default_supplier_id'] ?? null,
            isSellable: $data['is_sellable'],
            isPurchasable: $data['is_purchasable'],
            isAutoAssembly: $data['is_auto_assembly'],
            type: $data['type'],
            purchaseUom: $data['purchase_uom'] ?? null,
            purchaseUomConversionRate: $data['purchase_uom_conversion_rate'] ?? null,
            batchTracked: $data['batch_tracked'],
            operationsInSequence: $data['operations_in_sequence'],
            serialTracked: $data['serial_tracked'],
            archivedAt: isset($data['archived_at']) ? new DateTime($data['archived_at']) : null,
            variants: array_map(
                fn (array $item) => Variant::fromResponse($item),
                $data['variants'] ?? []
            ),
            configs: array_map(
                fn (array $item) => ProductConfig::fromResponse($item),
                $data['configs'] ?? []
            ),
            additionalInfo: $data['additional_info'] ?? null,
            customFieldCollectionId: $data['custom_field_collection_id'] ?? null,
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
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
