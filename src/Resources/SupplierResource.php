<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Supplier;
use Chirag\KatanaPhpSdk\Requests\Supplier\CreateSupplierRequest;
use Chirag\KatanaPhpSdk\Requests\Supplier\DeleteSupplierRequest;
use Chirag\KatanaPhpSdk\Requests\Supplier\ListSuppliersRequest;
use Chirag\KatanaPhpSdk\Requests\Supplier\UpdateSupplierRequest;
use Saloon\Http\BaseResource;

class SupplierResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListSuppliersRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function create(array $data): Supplier
    {
        $request = new CreateSupplierRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Supplier
    {
        $request = new UpdateSupplierRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteSupplierRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
