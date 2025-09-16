<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\PurchaseOrderRow;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow\CreatePurchaseOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow\DeletePurchaseOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow\ListPurchaseOrderRowsRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow\RetrievePurchaseOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\PurchaseOrderRow\UpdatePurchaseOrderRowRequest;
use Saloon\Http\BaseResource;

class PurchaseOrderRowResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListPurchaseOrderRowsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): PurchaseOrderRow
    {
        $request = new RetrievePurchaseOrderRowRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function create(array $data): PurchaseOrderRow
    {
        $request = new CreatePurchaseOrderRowRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): PurchaseOrderRow
    {
        $request = new UpdatePurchaseOrderRowRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeletePurchaseOrderRowRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
