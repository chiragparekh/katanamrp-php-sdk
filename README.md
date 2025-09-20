# Katana PHP SDK

A modern PHP SDK for the [Katana MRP API](https://developer.katanamrp.com/). This SDK provides a clean, fluent interface for interacting with Katana's manufacturing resource planning system.

## Installation

You can install the package via Composer:

```bash
composer require chirag/katana-php-sdk
```

## Basic Usage

First, you need to initialize the Katana client with your API token:

```php
<?php

require_once 'vendor/autoload.php';

use Chirag\KatanaPhpSdk\Katana;

$katana = new Katana('your-api-token');
```

## Products Resource Example

The SDK provides a fluent interface for working with Katana resources. Here's how you can work with products:

### List All Products

```php
// Get all products with pagination
$products = $katana->products()->all();

foreach ($products as $product) {
    echo "Product: {$product->name} - SKU: {$product->sku}\n";
}

// Get products with specific query parameters
$products = $katana->products()->all(['page' => 1, 'per_page' => 50]);
```

### Get a Specific Product

```php
$product = $katana->products()->get(1);
echo "Product Name: {$product->name}\n";
echo "Description: {$product->description}\n";
```

### Create a New Product

```php
$newProduct = $katana->products()->create([
    'name' => 'New Product',
    'sku' => 'NP-001',
    'description' => 'A new product description',
    'type' => 'product',
    'sales_price' => 99.99,
    'purchase_price' => 50.00,
]);

echo "Created product with ID: {$newProduct->id}\n";
```

### Update a Product

```php
$updatedProduct = $katana->products()->update(1, [
    'name' => 'Updated Product Name',
    'sales_price' => 129.99,
    'description' => 'Updated description',
]);

echo "Updated product: {$updatedProduct->name}\n";
```

### Delete a Product

```php
$katana->products()->delete(1);
echo "Product deleted successfully\n";
```

## Supported Resources

The Katana PHP SDK supports the following resources with full CRUD operations:

### Core Resources

- **Products** - Manage your product catalog
- **Materials** - Handle raw materials and components
- **Variants** - Product variants and configurations
- **Suppliers** - Supplier management
- **Customers** - Customer information and addresses
- **Locations** - Warehouse and facility locations

### Order Management

- **Sales Orders** - Customer sales orders and fulfillment
- **Sales Order Rows** - Individual line items in sales orders
- **Purchase Orders** - Supplier purchase orders
- **Purchase Order Rows** - Individual line items in purchase orders

### Manufacturing

- **Manufacturing Orders** - Production orders and scheduling
- **Manufacturing Order Operation Rows** - Manufacturing operations and tasks
- **Manufacturing Order Recipe Rows** - Recipe ingredients and materials
- **BOM Rows** - Bill of Materials for products

### Inventory & Operations

- **Inventory** - Current stock levels and inventory management
- **Inventory Movements** - Stock movements and transactions
- **Webhooks** - Event notifications and integrations

## Working with Other Resources

All resources follow the same pattern as the Products example above. Here are some additional examples:

### Sales Orders

```php
// List all sales orders
$salesOrders = $katana->salesOrders()->all();

// Create a new sales order
$salesOrder = $katana->salesOrders()->create([
    'customer_id' => 1,
    'location_id' => 1,
    'currency' => 'USD',
    'delivery_date' => '2024-12-31T08:00:00.000Z',
    'sales_order_rows' => [
        [
            'variant_id' => 1,
            'quantity' => 2,
            'price_per_unit' => 75.0,
            'tax_rate_id' => 1,
            'location_id' => 1,
        ]
    ]
]);

// Get returnable items for a sales order
$returnableItems = $katana->salesOrders()->getReturnableItems(1);
```

### Manufacturing Orders

```php
// List all manufacturing orders
$manufacturingOrders = $katana->manufacturingOrders()->all();

// Create a new manufacturing order
$manufacturingOrder = $katana->manufacturingOrders()->create([
    'variant_id' => 1,
    'planned_quantity' => 10,
    'location_id' => 1,
    'production_deadline_date' => '2024-12-31T08:00:00.000Z',
]);
```

### Inventory Management

```php
// Get current inventory
$inventory = $katana->inventory()->all();

// Update reorder point
$reorderPoint = $katana->inventory()->updateReorderPoint([
    'variant_id' => 1,
    'location_id' => 1,
    'value' => 50,
]);

// Get variants with negative stock
$negativeStock = $katana->inventory()->negativeStock();
```

### BOM (Bill of Materials)

```php
// List all BOM rows
$bomRows = $katana->bomRows()->all();

// Create a single BOM row
$bomRow = $katana->bomRows()->create([
    'product_item_id' => 1,
    'product_variant_id' => 1,
    'ingredient_variant_id' => 2,
    'quantity' => 3.5,
    'notes' => 'Main ingredient',
    'rank' => 10000,
]);

// Batch create multiple BOM rows
$batchBomRows = $katana->bomRows()->batchCreate([
    [
        'product_item_id' => 1,
        'product_variant_id' => 1,
        'ingredient_variant_id' => 2,
        'quantity' => 2.0,
        'rank' => 10000,
    ],
    [
        'product_item_id' => 1,
        'product_variant_id' => 1,
        'ingredient_variant_id' => 3,
        'quantity' => 1.5,
        'rank' => 20000,
    ]
]);
```

## Error Handling

The SDK will throw exceptions for API errors:

```php
try {
    $product = $katana->products()->get(999);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

## Pagination

Most list operations support pagination:

```php
// Get first page
$products = $katana->products()->all(['page' => 1]);

// Get specific page with custom per_page
$products = $katana->products()->all(['page' => 2, 'per_page' => 25]);
```

## Data Transfer Objects (DTOs)

All responses are automatically converted to strongly-typed DTOs with proper type hints:

```php
$product = $katana->products()->get(1);

// Access properties with full IDE support
echo $product->name;           // string
echo $product->salesPrice;     // float
echo $product->createdAt;      // string (ISO 8601 date)
echo $product->isActive;       // bool
```

## Requirements

- PHP 8.1 or higher
- Composer
- Guzzle HTTP client (automatically installed)

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For support, please open an issue on GitHub.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Katana MRP](https://katanamrp.com/) for the amazing API
- [Saloon PHP](https://saloon.dev/) for the HTTP client foundation
- All contributors who have helped improve this package
