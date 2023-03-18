<?php

declare(strict_types=1);


namespace Handrank\Tests\Application\Services;

use Handrank\Application\Domain\Exceptions\FileDoesNotExistException;
use Handrank\Application\Services\ReadFileService;
use PHPUnit\Framework\TestCase;

class ReadFileServiceTest extends TestCase
{
    /** @test */
    public function getsContentFromFile()
    {
        $readFileService = new ReadFileService(__DIR__ . '\..\..\..\storage\input.txt');

        $contentFromFile = $readFileService->getContentFromFile();

        $this->assertNotEmpty($contentFromFile);
    }

    /** @test */
    public function cannotGetContentFromFile()
    {
        $this->expectException(FileDoesNotExistException::class);

        $readFileService = new ReadFileService(__DIR__ . '\..\..\..\storage\hey.txt');

        $readFileService->getContentFromFile();
    }
}
