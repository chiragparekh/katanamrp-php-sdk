<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Material;
use Chirag\KatanaPhpSdk\Requests\Material\CreateMaterialRequest;
use Chirag\KatanaPhpSdk\Requests\Material\DeleteMaterialRequest;
use Chirag\KatanaPhpSdk\Requests\Material\ListMaterialsRequest;
use Chirag\KatanaPhpSdk\Requests\Material\RetrieveMaterialRequest;
use Chirag\KatanaPhpSdk\Requests\Material\UpdateMaterialRequest;
use Saloon\Http\BaseResource;

class MaterialResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListMaterialsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): Material
    {
        $request = new RetrieveMaterialRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function create(array $data): Material
    {
        $request = new CreateMaterialRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Material
    {
        $request = new UpdateMaterialRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteMaterialRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
