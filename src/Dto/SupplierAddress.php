<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class SupplierAddress
{
    public function __construct(
        public int $id,
        public int $supplierId,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zip,
        public string $country,
        public string $updatedAt,
        public string $createdAt,
        public ?string $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            supplierId: $data['supplier_id'],
            line1: $data['line_1'],
            line2: $data['line_2'] ?? null,
            city: $data['city'],
            state: $data['state'],
            zip: $data['zip'],
            country: $data['country'],
            updatedAt: $data['updated_at'],
            createdAt: $data['created_at'],
            deletedAt: $data['deleted_at'] ?? null,
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
