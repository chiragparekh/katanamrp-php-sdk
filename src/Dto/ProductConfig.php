<?php

namespace Chirag\KatanaPhpSdk\Dto;

class ProductConfig
{
    public function __construct(
        public int $id,
        public string $name,
        public array $values,
        public int $productId,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            values: $data['values'],
            productId: $data['product_id'],
        );
    }
}
