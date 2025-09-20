<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class AssignedOperator
{
    public function __construct(
        public int $operatorId,
        public string $name,
        public ?string $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            operatorId: $data['operator_id'],
            name: $data['name'],
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
