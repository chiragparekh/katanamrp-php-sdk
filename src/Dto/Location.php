<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
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
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?DateTime $deletedAt,
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
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
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
