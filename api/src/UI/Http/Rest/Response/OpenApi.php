<?php

declare(strict_types=1);

namespace UI\Http\Rest\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

final class OpenApi extends JsonResponse
{
    public function __construct(
        mixed $data = null,
        int $status = self::HTTP_OK,
        array $headers = [],
        bool $json = false,
        string $charset = 'UTF-8'
    ) {
        parent::__construct($data, $status, $headers, $json);

        $this->charset = $charset;
    }

    public static function fromPayload(mixed $payload, int $status, array $header = []): self
    {
        return new self($payload, $status, $header);
    }

    public static function empty(int $status): self
    {
        return new self(null, $status);
    }
}
