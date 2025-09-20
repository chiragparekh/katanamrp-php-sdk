<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\ReorderPoint;
use Chirag\KatanaPhpSdk\Dto\SafetyStock;
use Chirag\KatanaPhpSdk\Requests\Inventory\ListInventoryRequest;
use Chirag\KatanaPhpSdk\Requests\Inventory\ListNegativeStockRequest;
use Chirag\KatanaPhpSdk\Requests\Inventory\UpdateReorderPointRequest;
use Chirag\KatanaPhpSdk\Requests\Inventory\UpdateSafetyStockLevelRequest;
use Saloon\Http\BaseResource;

class InventoryResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListInventoryRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function negativeStock(array $query = []): iterable
    {
        $request = new ListNegativeStockRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function updateReorderPoint(array $data): ReorderPoint
    {
        $request = new UpdateReorderPointRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function updateSafetyStockLevel(array $data): SafetyStock
    {
        $request = new UpdateSafetyStockLevelRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }
}
