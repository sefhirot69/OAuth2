<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Persistence\Doctrine\Mapping\Client;

use App\Auth\Credential\Domain\Scope;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;

final class ClientScopeType extends JsonType
{
    private const NAME = 'auth_scope';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!is_array($value)) {
            $message = sprintf('In class %s the values must values of the class %s', __CLASS__, Scope::class);
            throw new \InvalidArgumentException($message);
        }

        try {
            /** @var Scope[] $value */
            $map = array_map(static fn (Scope $val): string => $val->value, $value);

            return json_encode($map, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): array
    {
        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $result = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

            return array_map(static fn ($r) => Scope::from($r), $result);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }
}
