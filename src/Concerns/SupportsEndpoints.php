<?php

namespace Chirag\KatanaPhpSdk\Concerns;

use Chirag\KatanaPhpSdk\Resources\MaterialResource;
use Chirag\KatanaPhpSdk\Resources\ProductResource;
use Chirag\KatanaPhpSdk\Resources\VariantResource;

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

    public function variants(): VariantResource
    {
        return new VariantResource($this);
    }
}
