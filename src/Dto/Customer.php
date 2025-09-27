<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class Customer
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $company,
        public ?string $email,
        public ?string $comment,
        public ?int $discountRate,
        public ?string $phone,
        public string $currency,
        public ?string $referenceId,
        public ?string $category,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public ?DateTime $deletedAt,
        public ?int $defaultBillingId,
        public ?int $defaultShippingId,
        public array $addresses,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            company: $data['company'] ?? null,
            email: $data['email'] ?? null,
            comment: $data['comment'] ?? null,
            discountRate: $data['discount_rate'] ?? null,
            phone: $data['phone'] ?? null,
            currency: $data['currency'],
            referenceId: $data['reference_id'] ?? null,
            category: $data['category'] ?? null,
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            deletedAt: isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
            defaultBillingId: $data['default_billing_id'] ?? null,
            defaultShippingId: $data['default_shipping_id'] ?? null,
            addresses: array_map(
                fn (array $item) => CustomerAddress::fromResponse($item),
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
