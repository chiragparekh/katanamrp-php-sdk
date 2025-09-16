<?php

namespace Chirag\KatanaPhpSdk\Concerns;

use Chirag\KatanaPhpSdk\Resources\MaterialResource;
use Chirag\KatanaPhpSdk\Resources\ProductResource;

trait SupportsEndpoints
{
    public function products(): ProductResource
    {
        return new ProductResource($this);
    }

    public function materials(): MaterialResource
    {
        return new MaterialResource($this);
    }
}
