<?php declare(strict_types=1);

namespace evgeny87\EmailVerifier;

final class Result
{
    public function __construct(
        private readonly string $email,
        private readonly bool $isValid,
        private readonly string $reason
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function __toString(): string
    {
        return sprintf(
            "[%s] %s (Reason: %s)",
            $this->isValid ? 'VALID' : 'INVALID',
            $this->email,
            $this->reason
        );
    }
}