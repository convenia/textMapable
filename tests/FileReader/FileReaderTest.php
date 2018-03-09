<?php

namespace Convenia\TextMap\Tests\Field;

use Convenia\TextMap\Exceptions\FileNotFoundException;
use Convenia\TextMap\FileReader;
use Convenia\TextMap\Tests\BaseTest;

class FileReaderTest extends BaseTest
{
    public function test_file_read_method()
    {
        (new FileReader())->read(__DIR__ . '/../Stubs/FileReader/reader_file_test.txt');
        $this->addToAssertionCount(1);
    }

    public function test_file_read_method_exception()
    {
        $this->expectException(FileNotFoundException::class);
        (new FileReader())->read('foo_bar.txt');
    }

    public function test_file_lines_parse()
    {
        $fileReader = (new FileReader())->read(__DIR__ . '/../Stubs/FileReader/reader_file_test.txt');
        $this->assertEquals(2, count($fileReader->getLines()));

    }
}