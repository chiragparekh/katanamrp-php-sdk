<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Location
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $legalName,
        public ?int $addressId,
        public ?LocationAddress $address,
        public bool $isPrimary,
        public bool $salesAllowed,
        public bool $purchaseAllowed,
        public bool $manufacturingAllowed,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            legalName: $data['legal_name'] ?? null,
            addressId: $data['address_id'] ?? null,
            address: isset($data['address']) ? LocationAddress::fromResponse($data['address']) : null,
            isPrimary: $data['is_primary'],
            salesAllowed: $data['sales_allowed'],
            purchaseAllowed: $data['purchase_allowed'] ?? true,
            manufacturingAllowed: $data['manufacturing_allowed'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
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
