<?php

namespace Chirag\KatanaPhpSdk\Dto;

class Pagination
{
    public function __construct(
        public int $totalRecords,
        public int $totalPages,
        public int $offset,
        public int $page,
        public bool $firstPage,
        public bool $lastPage,
    ) {}

    public static function fromResponse(array $data): self
    {
        return new self(
            totalRecords: (int) $data['total_records'],
            totalPages: (int) $data['total_pages'],
            offset: (int) $data['offset'],
            page: (int) $data['page'],
            firstPage: $data['first_page'] === 'true',
            lastPage: $data['last_page'] === 'true',
        );
    }
}
