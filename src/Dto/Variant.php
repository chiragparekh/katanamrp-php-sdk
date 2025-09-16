<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Variant
{
    public function __construct(
        public int $id,
        public ?string $sku,
        public ?float $salesPrice,
        public ?int $productId,
        public ?int $materialId,
        public ?float $purchasePrice,
        public string $type,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
        public ?string $internalBarcode,
        public ?string $registeredBarcode,
        public array $supplierItemCodes,
        public ?int $leadTime,
        public ?int $minimumOrderQuantity,
        public array $configAttributes,
        public ?array $customFields,
        public Product|Material|null $productOrMaterial,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            sku: $data['sku'] ?? null,
            salesPrice: $data['sales_price'] ?? null,
            productId: $data['product_id'] ?? null,
            materialId: $data['material_id'] ?? null,
            purchasePrice: $data['purchase_price'] ?? null,
            type: $data['type'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            deletedAt: $data['deleted_at'] ?? null,
            internalBarcode: $data['internal_barcode'] ?? null,
            registeredBarcode: $data['registered_barcode'] ?? null,
            supplierItemCodes: $data['supplier_item_codes'] ?? [],
            leadTime: $data['lead_time'] ?? null,
            minimumOrderQuantity: $data['minimum_order_quantity'] ?? null,
            configAttributes: array_map(
                fn (array $item) => ConfigAttribute::fromResponse($item),
                $data['config_attributes'] ?? []
            ),
            customFields: array_map(
                fn (array $item) => CustomField::fromResponse($item),
                $data['custom_fields'] ?? []
            ),
            productOrMaterial: isset($data['product_or_material'])
                ? ($data['product_or_material']['type'] === 'material'
                    ? Material::fromResponse($data['product_or_material'])
                    : Product::fromResponse($data['product_or_material']))
                : null,
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
