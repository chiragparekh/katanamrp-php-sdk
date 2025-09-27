<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Pagination;
use Chirag\KatanaPhpSdk\Dto\PurchaseOrder;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\CreatePurchaseOrderRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\DeletePurchaseOrderRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\ListPurchaseOrdersRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\ReceivePurchaseOrderRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\RetrievePurchaseOrderRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrder\UpdatePurchaseOrderRequest;
use Saloon\Http\BaseResource;

class PurchaseOrderResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListPurchaseOrdersRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): PurchaseOrder
    {
        $request = new RetrievePurchaseOrderRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function create(array $data): PurchaseOrder
    {
        $request = new CreatePurchaseOrderRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): PurchaseOrder
    {
        $request = new UpdatePurchaseOrderRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeletePurchaseOrderRequest($id);

        $this->connector->send($request);

        return $this;
    }

    public function receive(int $id, array $data = []): PurchaseOrder
    {
        $request = new ReceivePurchaseOrderRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function pagination(array $query = []): Pagination
    {
        $request = new ListPurchaseOrdersRequest;

        $request->query()->merge($query);
        $request->query()->add('page', 1);

        $response = $this->connector->send($request);

        return Pagination::fromResponse(json_decode($response->headers()->get('X-Pagination'), true));
    }
}
