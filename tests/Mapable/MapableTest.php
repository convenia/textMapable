<?php

namespace Convenia\TextMap\Tests\Field;

use Convenia\TextMap\Exceptions\FieldNotFoundException;
use Convenia\TextMap\Exceptions\FileNotFoundException;
use Convenia\TextMap\Mapable;
use Convenia\TextMap\Tests\BaseTest;
use Convenia\TextMap\Tests\Stubs\Field\FieldConcretClass;

class MapableTest extends BaseTest
{
    public function test_fields_add_array()
    {
        $mapable = new Mapable();
        $fields = $this->generateStubFields(4);
        $mapable->addField($fields);

        $this->assertEquals(count($fields), count($mapable->getFields()));
    }

    public function test_fields_add_single()
    {
        $mapable = new Mapable();
        $fields = $this->generateStubFields(1);
        $mapable->addField(current($fields));

        $this->assertEquals(count($fields), count($mapable->getFields()));
    }

    public function test_fields_add_validate()
    {
        $this->expectException(FieldNotFoundException::class);
        $mapable = new Mapable();
        $mapable->addField(new \stdClass());
    }

    public function test_read_file()
    {
        $mapable = new Mapable();
        $mapable->readFile(__DIR__ . '/../Stubs/FileReader/reader_file_test.txt');

        $this->addToAssertionCount(1);
    }

    public function test_read_file_with_error()
    {
        $this->expectException(FileNotFoundException::class);
        $mapable = new Mapable();
        $mapable->readFile('foo_ba.txt');
    }

    public function test_get_map()
    {
        $mapable = new Mapable();
        $mapable->readFile(__DIR__ . '/../Stubs/FileReader/reader_file_test.txt');
        $fields = [
            (new FieldConcretClass())
                ->setName('foo')
                ->setLength(2)
                ->setOffset(0),
            (new FieldConcretClass())
                ->setName('bar')
                ->setLength(2)
                ->setOffset(2),
        ];
        $mapable->addField($fields);
        $map = $mapable->getMap();

        $this->assertEquals(2, count($map));
        $this->assertArrayHasKey('bar', $map[0]);
        $this->assertArrayHasKey('foo', $map[1]);
    }

    private function generateStubFields($times)
    {
        $fields = [];
        for (;$times > 0; $times--) {
            $fields[] = new FieldConcretClass();
        }

        return $fields;
    }
}
