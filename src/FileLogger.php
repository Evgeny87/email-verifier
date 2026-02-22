<?php declare(strict_types=1);

namespace evgeny87\EmailVerifier;

class FileLogger
{
    public function __construct(
        private string $successLogPath = 'logs/passed.log',
        private string $errorLogPath = 'logs/failed.log'
    ) {}

    public function log(string $email, bool $isValid): void
    {
        $filePath = $isValid ? $this->successLogPath : $this->errorLogPath;

        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $entry = sprintf("[%s] %s" . PHP_EOL, date('d-m-Y H:i:s'), $email);
        file_put_contents($filePath, $entry, FILE_APPEND | LOCK_EX);
    }
}