<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class LocationAddress
{
    public function __construct(
        public int $id,
        public string $city,
        public string $country,
        public string $line1,
        public ?string $line2,
        public string $state,
        public string $zip,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            city: $data['city'],
            country: $data['country'],
            line1: $data['line_1'],
            line2: $data['line_2'] ?? null,
            state: $data['state'],
            zip: $data['zip'],
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
