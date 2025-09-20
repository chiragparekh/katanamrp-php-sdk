<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\SalesOrderRow;
use Chirag\KatanaPhpSdk\Requests\SalesOrderRow\CreateSalesOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrderRow\DeleteSalesOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrderRow\ListSalesOrderRowsRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrderRow\RetrieveSalesOrderRowRequest;
use Chirag\KatanaPhpSdk\Requests\SalesOrderRow\UpdateSalesOrderRowRequest;
use Saloon\Http\BaseResource;

class SalesOrderRowResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListSalesOrderRowsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): SalesOrderRow
    {
        $request = new RetrieveSalesOrderRowRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): SalesOrderRow
    {
        $request = new CreateSalesOrderRowRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): SalesOrderRow
    {
        $request = new UpdateSalesOrderRowRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteSalesOrderRowRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
