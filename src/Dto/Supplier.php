<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Supplier
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $email,
        public ?string $phone,
        public ?string $comment,
        public string $currency,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
        public ?int $defaultAddressId,
        public ?array $addresses,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            comment: $data['comment'] ?? null,
            currency: $data['currency'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            deletedAt: $data['deleted_at'] ?? null,
            defaultAddressId: $data['default_address_id'] ?? null,
            addresses: array_map(
                fn (array $item) => SupplierAddress::fromResponse($item),
                $data['addresses'] ?? []
            ),
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
