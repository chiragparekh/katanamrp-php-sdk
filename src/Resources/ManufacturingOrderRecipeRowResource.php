<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\ManufacturingOrderRecipeRow;
use Chirag\KatanaPhpSdk\Dto\Pagination;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow\CreateManufacturingOrderRecipeRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow\DeleteManufacturingOrderRecipeRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow\ListManufacturingOrderRecipeRowsRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow\RetrieveManufacturingOrderRecipeRowRequest;
use Chirag\KatanaPhpSdk\Requests\ManufacturingOrderRecipeRow\UpdateManufacturingOrderRecipeRowRequest;
use Saloon\Http\BaseResource;

class ManufacturingOrderRecipeRowResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListManufacturingOrderRecipeRowsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): ManufacturingOrderRecipeRow
    {
        $request = new RetrieveManufacturingOrderRecipeRowRequest($id);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function create(array $data): ManufacturingOrderRecipeRow
    {
        $request = new CreateManufacturingOrderRecipeRowRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): ManufacturingOrderRecipeRow
    {
        $request = new UpdateManufacturingOrderRecipeRowRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteManufacturingOrderRecipeRowRequest($id);

        $this->connector->send($request);

        return $this;
    }

    public function pagination(array $query = []): Pagination
    {
        $request = new ListManufacturingOrderRecipeRowsRequest;

        $request->query()->merge($query);
        $request->query()->add('page', 1);

        $response = $this->connector->send($request);

        return Pagination::fromResponse(json_decode($response->headers()->get('X-Pagination'), true));
    }
}
