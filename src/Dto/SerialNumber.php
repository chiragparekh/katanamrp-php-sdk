<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class SerialNumber
{
    public function __construct(
        public int $id,
        public string $transactionId,
        public string $serialNumber,
        public string $resourceType,
        public int $resourceId,
        public string $transactionDate,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            transactionId: $data['transaction_id'],
            serialNumber: $data['serial_number'],
            resourceType: $data['resource_type'],
            resourceId: $data['resource_id'],
            transactionDate: $data['transaction_date'],
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
