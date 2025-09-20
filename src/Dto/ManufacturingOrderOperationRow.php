<?php

namespace Chirag\KatanaPhpSdk\Dto;

use Saloon\Http\Response;

class ManufacturingOrderOperationRow
{
    public function __construct(
        public int $id,
        public string $status,
        public string $type,
        public int $rank,
        public int $manufacturingOrderId,
        public int $operationId,
        public string $operationName,
        public ?int $resourceId,
        public ?string $resourceName,
        public array $assignedOperators,
        public array $completedByOperators,
        public ?int $activeOperatorId,
        public float $plannedTimePerUnit,
        public float $plannedTimeParameter,
        public ?float $totalActualTime,
        public float $plannedCostPerUnit,
        public ?float $totalActualCost,
        public ?float $costPerHour,
        public ?float $costParameter,
        public ?int $groupBoundary,
        public bool $isStatusActionable,
        public ?string $completedAt,
        public string $createdAt,
        public string $updatedAt,
        public ?string $deletedAt,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            id: $data['id'],
            status: $data['status'],
            type: $data['type'],
            rank: $data['rank'],
            manufacturingOrderId: $data['manufacturing_order_id'],
            operationId: $data['operation_id'],
            operationName: $data['operation_name'],
            resourceId: $data['resource_id'] ?? null,
            resourceName: $data['resource_name'] ?? null,
            assignedOperators: array_map(
                fn (array $item) => AssignedOperator::fromResponse($item),
                $data['assigned_operators'] ?? []
            ),
            completedByOperators: array_map(
                fn (array $item) => CompletedOperator::fromResponse($item),
                $data['completed_by_operators'] ?? []
            ),
            activeOperatorId: $data['active_operator_id'] ?? null,
            plannedTimePerUnit: $data['planned_time_per_unit'],
            plannedTimeParameter: $data['planned_time_parameter'],
            totalActualTime: $data['total_actual_time'] ?? null,
            plannedCostPerUnit: $data['planned_cost_per_unit'],
            totalActualCost: $data['total_actual_cost'] ?? null,
            costPerHour: $data['cost_per_hour'] ?? null,
            costParameter: $data['cost_parameter'] ?? null,
            groupBoundary: $data['group_boundary'] ?? null,
            isStatusActionable: $data['is_status_actionable'],
            completedAt: $data['completed_at'] ?? null,
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            deletedAt: $data['deleted_at'] ?? null,
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
