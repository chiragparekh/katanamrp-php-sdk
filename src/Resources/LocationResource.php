<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Location;
use Chirag\KatanaPhpSdk\Requests\Location\ListLocationsRequest;
use Chirag\KatanaPhpSdk\Requests\Location\RetrieveLocationRequest;
use Saloon\Http\BaseResource;

class LocationResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListLocationsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): Location
    {
        $request = new RetrieveLocationRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }
}
