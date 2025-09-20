<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderOperationRow;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow\CreateManufacturingOrderOperationRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow\DeleteManufacturingOrderOperationRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow\ListManufacturingOrderOperationRowsRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow\RetrieveManufacturingOrderOperationRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderOperationRow\UpdateManufacturingOrderOperationRowRequest;
use Saloon\Http\BaseResource;

class ManufacturingOrderOperationRowResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListManufacturingOrderOperationRowsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): ManufacturingOrderOperationRow
    {
        $request = new RetrieveManufacturingOrderOperationRowRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): ManufacturingOrderOperationRow
    {
        $request = new CreateManufacturingOrderOperationRowRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): ManufacturingOrderOperationRow
    {
        $request = new UpdateManufacturingOrderOperationRowRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteManufacturingOrderOperationRowRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
