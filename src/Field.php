<?php

namespace Convenia\TextMap;

abstract class Field
{
    protected $name = '';
    protected $length = 0;
    protected $offset = 0;
    protected $value = '';

    /**
     * @param string $name
     * @return Field
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $lenght
     * @return Field
     */
    public function setLength($lenght)
    {
        $this->length = $lenght;

        return $this;
    }

    /**
     * @param int $offset
     * @return Field
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $string
     * @return Field
     */
    public function parseString($string)
    {
        $this->value = substr($string, $this->offset, $this->length);

        return $this;
    }

    /**
     * @return array
     */
    public function getFormated()
    {
        return [
            'length' => $this->length,
            'offset' => $this->offset,
            'value' => $this->value,
        ];
    }

    /**
     * @param string $name
     * @param array $recitableFormat
     * @return Field
     */
    public function reverseRecitable(string $name, array $recitableFormat)
    {
        $this->name = $name;
        $this->length = $recitableFormat['length'];
        $this->offset = $recitableFormat['position'];

        return $this;
    }
}
