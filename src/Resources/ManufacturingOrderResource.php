<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrder;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrder\CreateManufacturingOrderRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrder\DeleteManufacturingOrderRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrder\ListManufacturingOrdersRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrder\RetrieveManufacturingOrderRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrder\UpdateManufacturingOrderRequest;
use Saloon\Http\BaseResource;

class ManufacturingOrderResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListManufacturingOrdersRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): ManufacturingOrder
    {
        $request = new RetrieveManufacturingOrderRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): ManufacturingOrder
    {
        $request = new CreateManufacturingOrderRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): ManufacturingOrder
    {
        $request = new UpdateManufacturingOrderRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteManufacturingOrderRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
