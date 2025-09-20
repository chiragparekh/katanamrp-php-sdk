<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class BomRow
{
    public function __construct(
        public string $id,
        public int $productItemId,
        public int $productVariantId,
        public int $ingredientVariantId,
        public float $quantity,
        public ?string $notes,
        public int $rank,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            productItemId: $data['product_item_id'],
            productVariantId: $data['product_variant_id'],
            ingredientVariantId: $data['ingredient_variant_id'],
            quantity: $data['quantity'],
            notes: $data['notes'] ?? null,
            rank: $data['rank'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
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
