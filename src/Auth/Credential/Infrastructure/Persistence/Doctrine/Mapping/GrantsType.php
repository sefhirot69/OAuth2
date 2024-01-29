<?php

declare(strict_types=1);

namespace App\Auth\Credential\Infrastructure\Persistence\Doctrine\Mapping;

use App\Auth\Credential\Domain\Grants;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;

final class GrantsType extends JsonType
{
    private const NAME = 'auth_grant';

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof Grants) {
            $message = sprintf('In class %s the values must values of the class %s', __CLASS__, Grants::class);
            throw new \InvalidArgumentException($message);
        }

        try {
            return json_encode($value->toPrimitives(), JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Grants
    {
        if (is_resource($value)) {
            $value = stream_get_contents($value);
        }

        try {
            $result = json_decode($value, true, 512, JSON_THROW_ON_ERROR);

            return Grants::fromArray($result);
        } catch (\JsonException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }
}
