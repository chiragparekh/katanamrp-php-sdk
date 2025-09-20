<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Requests\InventoryMovement\ListInventoryMovementsRequest;
use Saloon\Http\BaseResource;

class InventoryMovementResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListInventoryMovementsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }
}
