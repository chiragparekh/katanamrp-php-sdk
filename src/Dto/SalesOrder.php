<?php

namespace Chirag\KatanaPhpSdk\Dto;

use DateTime;
use Saloon\Http\Response;

class SalesOrder
{
    public function __construct(
        public int $id,
        public ?int $customerId,
        public string $orderNo,
        public string $source,
        public DateTime $orderCreatedDate,
        public DateTime $deliveryDate,
        public int $locationId,
        public string $status,
        public string $currency,
        public ?float $conversionRate,
        public float $total,
        public float $totalInBaseCurrency,
        public ?DateTime $conversionDate,
        public string $productAvailability,
        public ?DateTime $productExpectedDate,
        public string $ingredientAvailability,
        public ?DateTime $ingredientExpectedDate,
        public string $productionStatus,
        public string $invoicingStatus,
        public ?string $additionalInfo,
        public ?string $customerRef,
        public ?DateTime $pickedDate,
        public ?string $ecommerceOrderType,
        public ?string $ecommerceStoreName,
        public ?string $ecommerceOrderId,
        public DateTime $createdAt,
        public DateTime $updatedAt,
        public array $salesOrderRows,
        public ?string $trackingNumber,
        public ?string $trackingNumberUrl,
        public ?int $billingAddressId,
        public ?int $shippingAddressId,
        public array $addresses,
        public ?ShippingFee $shippingFee,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            customerId: $data['customer_id'] ?? null,
            orderNo: $data['order_no'],
            source: $data['source'],
            orderCreatedDate: new DateTime($data['order_created_date']),
            deliveryDate: new DateTime($data['delivery_date']),
            locationId: $data['location_id'],
            status: $data['status'],
            currency: $data['currency'],
            conversionRate: $data['conversion_rate'] ?? null,
            total: $data['total'],
            totalInBaseCurrency: $data['total_in_base_currency'],
            conversionDate: isset($data['conversion_date']) ? new DateTime($data['conversion_date']) : null,
            productAvailability: $data['product_availability'],
            productExpectedDate: isset($data['product_expected_date']) ? new DateTime($data['product_expected_date']) : null,
            ingredientAvailability: $data['ingredient_availability'],
            ingredientExpectedDate: isset($data['ingredient_expected_date']) ? new DateTime($data['ingredient_expected_date']) : null,
            productionStatus: $data['production_status'],
            invoicingStatus: $data['invoicing_status'],
            additionalInfo: $data['additional_info'] ?? null,
            customerRef: $data['customer_ref'] ?? null,
            pickedDate: isset($data['picked_date']) ? new DateTime($data['picked_date']) : null,
            ecommerceOrderType: $data['ecommerce_order_type'] ?? null,
            ecommerceStoreName: $data['ecommerce_store_name'] ?? null,
            ecommerceOrderId: $data['ecommerce_order_id'] ?? null,
            createdAt: new DateTime($data['created_at']),
            updatedAt: new DateTime($data['updated_at']),
            salesOrderRows: array_map(
                fn (array $item) => SalesOrderRow::fromResponse($item),
                $data['sales_order_rows'] ?? []
            ),
            trackingNumber: $data['tracking_number'] ?? null,
            trackingNumberUrl: $data['tracking_number_url'] ?? null,
            billingAddressId: $data['billing_address_id'] ?? null,
            shippingAddressId: $data['shipping_address_id'] ?? null,
            addresses: array_map(
                fn (array $item) => SalesOrderAddress::fromResponse($item),
                $data['addresses'] ?? []
            ),
            shippingFee: isset($data['shipping_fee']) && ! empty($data['shipping_fee']) ? ShippingFee::fromResponse($data['shipping_fee']) : null,
        );
    }

    public static function collect(Response $response): array
    {
        return array_map(
            fn (array $item) => self::fromResponse($item),
            $response->json('data')
        );
    }
}
