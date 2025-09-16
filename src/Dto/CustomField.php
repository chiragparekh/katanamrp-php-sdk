<?php

namespace Chirag\KatanaPhpSdk\Dto;

class CustomField
{
    public function __construct(
        public string $fieldName,
        public string $fieldValue,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            fieldName: $data['field_name'],
            fieldValue: $data['field_value'],
        );
    }
}
