<?php

declare(strict_types=1);

namespace UI\Http\Rest\Response;

use ArrayObject;
use JsonException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 */
final class OpenApiTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testEmpty(): void
    {
        $response = OpenApi::empty(Response::HTTP_UNAUTHORIZED);

        self::assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        self::assertSame(\json_encode(new ArrayObject(), JSON_THROW_ON_ERROR), $response->getContent());
    }

    /**
     * @throws JsonException
     */
    public function testFromPayload(): void
    {
        $response = OpenApi::fromPayload([
            'email' => 'some@email.com',
        ], Response::HTTP_OK);

        $content = $response->getContent();
        if ($content === false) {
            self::fail('Content is false');
        }

        /** @var array{email: string} $decode */
        $decode = \json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        self::assertArrayHasKey('email', $decode);
        self::assertSame('some@email.com', $decode['email']);
    }
}
