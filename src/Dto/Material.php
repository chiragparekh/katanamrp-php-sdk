<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class Material
{
    public function __construct(
        public int $id,
        public string $name,
        public string $uom,
        public ?string $categoryName,
        public ?int $defaultSupplierId,
        public string $type,
        public ?string $purchaseUom,
        public ?float $purchaseUomConversionRate,
        public bool $batchTracked,
        public ?bool $isSellable,
        public ?DateTime $archivedAt,
        public array $variants,
        public array $configs,
        public ?string $additionalInfo,
        public ?int $customFieldCollectionId,
        public ?DateTime $createdAt,
        public ?DateTime $updatedAt,
        public ?DateTime $deletedAt,
        public ?Supplier $supplier,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            uom: $data['uom'],
            categoryName: $data['category_name'] ?? null,
            defaultSupplierId: $data['default_supplier_id'] ?? null,
            type: $data['type'],
            purchaseUom: $data['purchase_uom'] ?? null,
            purchaseUomConversionRate: $data['purchase_uom_conversion_rate'] ?? null,
            batchTracked: $data['batch_tracked'],
            isSellable: $data['is_sellable'] ?? null,
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
            createdAt: isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            updatedAt: isset($data['updated_at']) ? new DateTime($data['updated_at']) : null,
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
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
