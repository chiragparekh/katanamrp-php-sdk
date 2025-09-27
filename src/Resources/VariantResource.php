<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Pagination;
use Chirag\KatanaPhpSdk\Dto\Variant;
use Chirag\KatanaPhpSdk\Requests\Variant\CreateVariantRequest;
use Chirag\KatanaPhpSdk\Requests\Variant\DeleteVariantRequest;
use Chirag\KatanaPhpSdk\Requests\Variant\ListVariantsRequest;
use Chirag\KatanaPhpSdk\Requests\Variant\RetrieveVariantRequest;
use Chirag\KatanaPhpSdk\Requests\Variant\UpdateVariantRequest;
use Saloon\Http\BaseResource;

class VariantResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListVariantsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): Variant
    {
        $request = new RetrieveVariantRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function create(array $data): Variant
    {
        $request = new CreateVariantRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Variant
    {
        $request = new UpdateVariantRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteVariantRequest($id);

        $this->connector->send($request);

        return $this;
    }

    public function pagination(array $query = []): Pagination
    {
        $request = new ListVariantsRequest;

        $request->query()->merge($query);
        $request->query()->add('page', 1);

        $response = $this->connector->send($request);

        return Pagination::fromResponse(json_decode($response->headers()->get('X-Pagination'), true));
    }
}
