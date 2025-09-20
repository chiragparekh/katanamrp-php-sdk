<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class CustomerAddress
{
    public function __construct(
        public int $id,
        public int $customerId,
        public string $entityType,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $company,
        public ?string $phone,
        public string $line1,
        public ?string $line2,
        public ?string $city,
        public ?string $state,
        public ?string $zip,
        public ?string $country,
        public string $updatedAt,
        public string $createdAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            customerId: $data['customer_id'],
            entityType: $data['entity_type'],
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            company: $data['company'] ?? null,
            phone: $data['phone'] ?? null,
            line1: $data['line_1'],
            line2: $data['line_2'] ?? null,
            city: $data['city'] ?? null,
            state: $data['state'] ?? null,
            zip: $data['zip'] ?? null,
            country: $data['country'] ?? null,
            updatedAt: $data['updated_at'],
            createdAt: $data['created_at'],
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
