<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class Attribute
{
    public function __construct(
        public string $key,
        public string $value,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            key: $data['key'],
            value: $data['value'],
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
