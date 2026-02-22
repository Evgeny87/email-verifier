<?php declare(strict_types=1);

namespace evgeny87\EmailVerifier;

class EmailVerifier
{
    public function __construct(
        private ?FileLogger $logger = null
    ) {}

    /**
     * @param string[] $emails
     * @return array<string, bool>
     */
    public function verifyList(array $emails): array
    {
        $results = [];
        foreach ($emails as $email) {
            $email = trim($email);
            $isValid = $this->verify($email);
            $results[$email] = $isValid;

            if ($this->logger) {
                $this->logger->log($email, $isValid);
            }
        }
        return $results;
    }

    public function verify(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = (string) substr(strrchr($email, "@"), 1);
        return checkdnsrr($domain, "MX");
    }
}
