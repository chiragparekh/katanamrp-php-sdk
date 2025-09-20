<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class ShippingFee
{
    public function __construct(
        public int $id,
        public int $salesOrderId,
        public ?string $description,
        public float $amount,
        public int $taxRateId,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            salesOrderId: $data['sales_order_id'],
            description: $data['description'] ?? null,
            amount: $data['amount'],
            taxRateId: $data['tax_rate_id'],
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
