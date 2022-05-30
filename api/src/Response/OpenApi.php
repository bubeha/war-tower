<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\JsonResponse;

final class OpenApi extends JsonResponse
{
    protected $charset = 'UTF-8';

    public function __construct(
        mixed $data = null,
        int $status = self::HTTP_OK,
        array $headers = [],
        bool $json = false
    ) {
        parent::__construct($data, $status, $headers, $json);
    }

    public static function fromPayload(array $payload, int $status, array $header = []): self
    {
        return new self($payload, $status, $header);
    }
}
