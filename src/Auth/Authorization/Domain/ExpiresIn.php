<?php

declare(strict_types=1);

namespace App\Auth\Authorization\Domain;

final class ExpiresIn
{
    public const EXPIRES_IN_TOKEN         = 'PT8H';
    public const EXPIRES_IN_REFRESH_TOKEN = 'P1M';

    private function __construct(
        private readonly \DateTimeImmutable $value,
    ) {
    }

    public static function makeExpiresInToken(): self
    {
        $now = new \DateTimeImmutable();

        return new self(
            $now->add(new \DateInterval(self::EXPIRES_IN_TOKEN))
        );
    }

    public static function makeExpiresInRefreshToken(): self
    {
        $now = new \DateTimeImmutable();

        return new self(
            $now->add(new \DateInterval(self::EXPIRES_IN_REFRESH_TOKEN))
        );
    }

    public function value(): \DateTimeImmutable
    {
        return $this->value;
    }
}
