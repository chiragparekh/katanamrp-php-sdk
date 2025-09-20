<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class BatchTransaction
{
    public function __construct(
        public int $batchId,
        public float $quantity,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            batchId: $data['batch_id'],
            quantity: $data['quantity'],
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
