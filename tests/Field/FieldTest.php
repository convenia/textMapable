<?php

namespace Convenia\TextMap\Tests\Field;

use Convenia\TextMap\Tests\BaseTest;
use Convenia\TextMap\Tests\Stubs\Field\FieldConcretClass;

class FieldTest extends BaseTest
{
    public function test_field_reverse_recitable()
    {
        $recitableFormat = [
            'format' => 'SomeCoolClass',
            'position' => 2,
            'length' => 15,
            'defaultValue' => 10,
        ];
        $concretFieldClass = new FieldConcretClass();
        $concretFieldClass->reverseRecitable('fooType', $recitableFormat);

        $this->assertEquals('fooType', $concretFieldClass->getName());
        $this->assertEquals($recitableFormat['position'], $concretFieldClass->getOffset());
        $this->assertEquals($recitableFormat['length'], $concretFieldClass->getLength());
    }

    public function test_field_parse_string()
    {
        $concretFieldClass = new FieldConcretClass();
        $stringTest = '123456789abcdefg';
        $concretFieldClass
            ->setName('foo')
            ->setLength(2)
            ->setOffset(0)
            ->parseString($stringTest); //Expected value: 12

        $this->assertEquals('12', $concretFieldClass->getValue());
    }

    public function test_field_formated_return()
    {
        $concretFieldClass = new FieldConcretClass();
        $stringTest = '123456789abcdefg';
        $concretFieldClass
            ->setName('foo')
            ->setLength(4)
            ->setOffset(2)
            ->parseString($stringTest); //Expected value: 3456

        $this->assertEquals([
            'length' => 4,
            'offset' => 2,
            'value' => '3456',
        ], $concretFieldClass->getFormated());
    }
}
