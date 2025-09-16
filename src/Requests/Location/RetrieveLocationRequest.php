<?php

namespace Chirag\KatanaPhpSdk\Requests\Location;

use Chirag\KatanaPhpSdk\Dto\Location;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class RetrieveLocationRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private int $id
    ) {}

    public function resolveEndpoint(): string
    {
        return "/locations/{$this->id}";
    }

    public function createDtoFromResponse(Response $response): Location
    {
        return Location::fromResponse($response->json());
    }
}
