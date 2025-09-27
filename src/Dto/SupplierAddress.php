<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class SupplierAddress
{
    public function __construct(
        public int $id,
        public int $supplierId,
        public ?string $line1,
        public ?string $line2,
        public ?string $city,
        public ?string $state,
        public ?string $zip,
        public ?string $country,
        public DateTime $updatedAt,
        public DateTime $createdAt,
        public ?DateTime $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            supplierId: $data['supplier_id'],
            line1: $data['line_1'] ?? null,
            line2: $data['line_2'] ?? null,
            city: $data['city'] ?? null,
            state: $data['state'] ?? null,
            zip: $data['zip'] ?? null,
            country: $data['country'] ?? null,
            updatedAt: new DateTime($data['updated_at']),
            createdAt: new DateTime($data['created_at']),
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
