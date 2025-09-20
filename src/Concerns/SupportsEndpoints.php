<?php

namespace Chirag\KatanaPhpSdk\Concerns;

use Chirag\KatanaPhpSdk\Resources\InventoryMovementResource;
use Chirag\KatanaPhpSdk\Resources\InventoryResource;
use Chirag\KatanaPhpSdk\Resources\LocationResource;
use Chirag\KatanaPhpSdk\Resources\ManufacturingOrderOperationRowResource;
use Chirag\KatanaPhpSdk\Resources\ManufacturingOrderRecipeRowResource;
use Chirag\KatanaPhpSdk\Resources\ManufacturingOrderResource;
use Chirag\KatanaPhpSdk\Resources\MaterialResource;
use Chirag\KatanaPhpSdk\Resources\ProductResource;
use Chirag\KatanaPhpSdk\Resources\PurchaseOrderResource;
use Chirag\KatanaPhpSdk\Resources\PurchaseOrderRowResource;
use Chirag\KatanaPhpSdk\Resources\SupplierResource;
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

    public function purchaseOrders(): PurchaseOrderResource
    {
        return new PurchaseOrderResource($this);
    }

    public function purchaseOrderRows(): PurchaseOrderRowResource
    {
        return new PurchaseOrderRowResource($this);
    }

    public function suppliers(): SupplierResource
    {
        return new SupplierResource($this);
    }

    public function locations(): LocationResource
    {
        return new LocationResource($this);
    }

    public function inventory(): InventoryResource
    {
        return new InventoryResource($this);
    }

    public function inventoryMovements(): InventoryMovementResource
    {
        return new InventoryMovementResource($this);
    }

    public function manufacturingOrders(): ManufacturingOrderResource
    {
        return new ManufacturingOrderResource($this);
    }

    public function manufacturingOrderOperationRows(): ManufacturingOrderOperationRowResource
    {
        return new ManufacturingOrderOperationRowResource($this);
    }

    public function manufacturingOrderRecipeRows(): ManufacturingOrderRecipeRowResource
    {
        return new ManufacturingOrderRecipeRowResource($this);
    }
}
