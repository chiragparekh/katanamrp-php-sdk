<?php

namespace Chirag\KatanaPhpSdk;

use Chirag\KatanaPhpSdk\Concerns\SupportsEndpoints;
use Chirag\KatanaPhpSdk\Exceptions\KatanaException;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class Katana extends Connector implements HasPagination
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use SupportsEndpoints;

    protected string $apiToken;

    protected string $baseUrl;

    protected int $timeoutInSeconds;

    public function __construct(
        string $apiToken,
        string $baseUrl = 'https://api.katanamrp.com/v1/',
        int $timeoutInSeconds = 10,
    ) {
        $this->apiToken = $apiToken;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->timeoutInSeconds = $timeoutInSeconds;
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return new KatanaException(
            $response,
            $senderException?->getMessage() ?? 'Request failed',
            $senderException?->getCode() ?? 0,
        );
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiToken);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultConfig(): array
    {
        return [
            'timeout' => $this->timeoutInSeconds,
        ];
    }

    public function paginate(Request $request): Paginator
    {
        return new class(connector: $this, request: $request) extends Paginator
        {
            protected ?int $perPageLimit = 250;

            protected function isLastPage(Response $response): bool
            {
                $pagination = json_decode($response->headers()->get('X-Pagination'), true);

                return filter_var($pagination['last_page'], FILTER_VALIDATE_BOOLEAN);
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $request->createDtoFromResponse($response);
            }

            protected function applyPagination(Request $request): Request
            {
                $request->query()->add('page', $this->currentPage + 1);

                if (isset($this->perPageLimit)) {
                    $request->query()->add('limit', $this->perPageLimit);
                }

                return $request;
            }
        };
    }
}
