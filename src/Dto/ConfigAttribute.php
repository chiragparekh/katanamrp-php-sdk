<?php

namespace Chirag\KatanaPhpSdk\Dto;

class ConfigAttribute
{
    public function __construct(
        public string $configName,
        public string $configValue,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            configName: $data['config_name'],
            configValue: $data['config_value'],
        );
    }
}
