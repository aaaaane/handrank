<?php

declare(strict_types=1);

namespace Handrank\Application\Services;

use Exception;
use Handrank\Application\Domain\Exceptions\FileDoesNotExistException;

class ReadFileService
{
    /** @const string */
    private const FILE_PATH = '../../../storage/input.txt';

    public function __construct()
    {
    }

    public function getContentFromFile()
    {
        try {
            $fileContent = file_get_contents(self::FILE_PATH);
        } catch (Exception $exception) {
            throw new FileDoesNotExistException($exception->getMessage());
        }

        $validator = Validator::create($fileContent);
        if (!$validator->isValid()) {
            throw new InvalidFileContentException(
                $validator->error() ?? 'Unknown Error'
            );
        }
        $hands = explode(PHP_EOL, $fileContent);
    }

}
