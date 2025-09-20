<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\SalesOrder;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\CreateSalesOrderRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\DeleteSalesOrderRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\GetReturnableItemsRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\ListSalesOrdersRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\RetrieveSalesOrderRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrder\UpdateSalesOrderRequest;
use Saloon\Http\BaseResource;

class SalesOrderResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListSalesOrdersRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): SalesOrder
    {
        $request = new RetrieveSalesOrderRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): SalesOrder
    {
        $request = new CreateSalesOrderRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): SalesOrder
    {
        $request = new UpdateSalesOrderRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteSalesOrderRequest($id);

        $this->connector->send($request);

        return $this;
    }

    public function getReturnableItems(int $id): array
    {
        $request = new GetReturnableItemsRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }
}
