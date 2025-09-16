<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Material
{
    public function __construct(
        public int $id,
        public string $name,
        public string $uom,
        public string $categoryName,
        public int $defaultSupplierId,
        public string $type,
        public string $purchaseUom,
        public float $purchaseUomConversionRate,
        public bool $batchTracked,
        public bool $isSellable,
        public ?string $archivedAt,
        public array $variants,
        public array $configs,
        public ?string $additionalInfo,
        public ?int $customFieldCollectionId,
        public string $createdAt,
        public string $updatedAt,
        public ?Supplier $supplier,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            uom: $data['uom'],
            categoryName: $data['category_name'],
            defaultSupplierId: $data['default_supplier_id'],
            type: $data['type'],
            purchaseUom: $data['purchase_uom'],
            purchaseUomConversionRate: $data['purchase_uom_conversion_rate'],
            batchTracked: $data['batch_tracked'],
            isSellable: $data['is_sellable'],
            archivedAt: $data['archived_at'] ?? null,
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
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
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
