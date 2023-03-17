<?php

declare(strict_types=1);

namespace Handrank\Application\Services;

use Handrank\Application\Domain\Exceptions\FileDoesNotExistException;

class ReadFileService
{
    /** @const string */
    private const FILE_PATH = __DIR__ . '\..\..\..\storage\input.txt';

    public function __construct()
    {
    }

    /**
     * @throws FileDoesNotExistException
     */
    public function getContentFromFile(): string
    {
        $fileContent = file_get_contents(self::FILE_PATH);

        if ($fileContent === false) {
            throw new FileDoesNotExistException('There was an error.');
        }

        return $fileContent;
    }
}
