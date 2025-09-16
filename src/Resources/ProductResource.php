<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Product;
use Chirag\KatanaPhpSdk\Requests\Product\CreateProductRequest;
use Chirag\KatanaPhpSdk\Requests\Product\DeleteProductRequest;
use Chirag\KatanaPhpSdk\Requests\Product\ListProductsRequest;
use Chirag\KatanaPhpSdk\Requests\Product\RetrieveProductRequest;
use Chirag\KatanaPhpSdk\Requests\Product\UpdateProductRequest;
use Saloon\Http\BaseResource;

class ProductResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListProductsRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->items();
    }

    public function get(int $id): Product
    {
        $request = new RetrieveProductRequest($id);

        $response = $this->connector->send($request);

        return $response->dtoOrFail();
    }

    public function create(array $data): Product
    {
        $request = new CreateProductRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Product
    {
        $request = new UpdateProductRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteProductRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
