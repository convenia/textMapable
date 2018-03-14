<?php

namespace Convenia\TextMap;

use Convenia\TextMap\Exceptions\FieldNotFoundException;

class Mapable
{
    protected $fields = [];
    protected $fileReader;
    protected $map = [];

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }
    /**
     * @param $fields
     * @return $this
     * @throws FieldNotFoundException
     */
    public function addField($fields)
    {
        if (is_array($fields)) {
            array_map([$this, 'validateFieldsInArray'], $fields);
            $this->fields = array_merge($this->fields, $fields);

            return $this;
        }

        if ($fields instanceof Field) {
            $this->fields[] = $fields;

            return $this;
        }

        throw new FieldNotFoundException();
    }

    /**
     * @param $file
     * @return $this
     * @throws \Convenia\TextMap\Exceptions\FileNotFoundException
     */
    public function readFile(string $file)
    {
        $this->fileReader = (new FileReader())->read($file);

        return $this;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        array_map([$this, 'parseStringToMap'], $this->fileReader->getLines());

        return $this->map;
    }

    /**
     * @param string $line
     */
    private function parseStringToMap(string $line)
    {
        $fields = [];
        foreach ($this->getFields() as $field) {
            $fields[$field->getName()] = $field
                ->parseString($line)
                ->getFormated();
        }
        $this->map[] = $fields;
    }

    /**
     * @param $field
     * @return mixed
     * @throws FieldNotFoundException
     */
    private function validateFieldsInArray($field)
    {
        if ($field instanceof Field) {
            return $field;
        }

        throw new FieldNotFoundException();
    }
}
