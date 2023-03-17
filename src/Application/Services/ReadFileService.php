<?php

declare(strict_types=1);

namespace Handrank\Application\Services;

use Handrank\Application\Domain\Exceptions\FileDoesNotExistException;
use Throwable;

readonly class ReadFileService
{
    public function __construct(private string $filePath)
    {
    }

    /**
     * @throws FileDoesNotExistException
     */
    public function getContentFromFile(): string
    {
        try {
            $fileContent = file_get_contents($this->filePath());
        } catch (Throwable $exception) {
            throw new FileDoesNotExistException($exception->getMessage());
        }

        if ($fileContent === false) {
            throw new FileDoesNotExistException('There was an error.');
        }

        return $fileContent;
    }

    public function filePath(): string
    {
        return $this->filePath;
    }
}
