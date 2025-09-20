<?php

namespace Chirag\KatanaPhpSdk\Resources;

use Chirag\KatanaPhpSdk\Dto\Customer;
use Chirag\KatanaPhpSdk\Requests\Customer\CreateCustomerRequest;
use Chirag\KatanaPhpSdk\Requests\Customer\DeleteCustomerRequest;
use Chirag\KatanaPhpSdk\Requests\Customer\ListCustomersRequest;
use Chirag\KatanaPhpSdk\Requests\Customer\UpdateCustomerRequest;
use Saloon\Http\BaseResource;

class CustomerResource extends BaseResource
{
    public function all(array $query = []): iterable
    {
        $request = new ListCustomersRequest;

        $request->query()->merge($query);

        /** @var \Chirag\KatanaPhpSdk\Katana $connector */
        $connector = $this->connector;

        if (isset($query['page'])) {
            $response = $connector->send($request);

            return $response->dtoOrFail();
        }

        return $connector->paginate($request)->setStartPage(120)->items();
    }

    public function create(array $data): Customer
    {
        $request = new CreateCustomerRequest($data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function update(int $id, array $data): Customer
    {
        $request = new UpdateCustomerRequest($id, $data);

        return $this->connector->send($request)->dtoOrFail();
    }

    public function delete(int $id): self
    {
        $request = new DeleteCustomerRequest($id);

        $this->connector->send($request);

        return $this;
    }
}
