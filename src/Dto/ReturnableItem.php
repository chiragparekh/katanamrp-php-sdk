<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class ReturnableItem
{
    public function __construct(
        public int $variantId,
        public int $fulfillmentRowId,
        public float $availableForReturnQuantity,
        public float $netPricePerUnit,
        public int $locationId,
        public float $quantitySold,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            variantId: $data['variant_id'],
            fulfillmentRowId: $data['fulfillment_row_id'],
            availableForReturnQuantity: $data['available_for_return_quantity'],
            netPricePerUnit: $data['net_price_per_unit'],
            locationId: $data['location_id'],
            quantitySold: $data['quantity_sold'],
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json()
        );
    }
}
