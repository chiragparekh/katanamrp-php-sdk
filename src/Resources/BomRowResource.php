<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\BomRow;
use Chirag\KatanaPhpSdk\Dto\Pagination;
use Chirag\KatanaPhpSdk\Requests\BomRow\BatchCreateBomRowsRequest;
use Chirag\KatanaPhpSdk\Requests\BomRow\CreateBomRowRequest;
use Chirag\KatanaPhpSdk\Requests\BomRow\DeleteBomRowRequest;
use Chirag\KatanaPhpSdk\Requests\BomRow\ListBomRowsRequest;
use Chirag\KatanaPhpSdk\Requests\BomRow\UpdateBomRowRequest;
use Saloon\Http\BaseResource;

class BomRowResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListBomRowsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function create(array $data): BomRow
    {
        $request = new CreateBomRowRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function batchCreate(array $data): array
    {
        $request = new BatchCreateBomRowsRequest($data);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function update(string $id, array $data): BomRow
    {
        $request = new UpdateBomRowRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(string $id): self
    {
        $request = new DeleteBomRowRequest($id);

        $this->connector->send($request);

        return $this;
    }

    public function pagination(array $query = []): Pagination
    {
        $request = new ListBomRowsRequest;

        $request->query()->merge($query);
        $request->query()->add('page', 1);

        $response = $this->connector->send($request);

        return Pagination::fromResponse(json_decode($response->headers()->get('X-Pagination'), true));
    }
}
