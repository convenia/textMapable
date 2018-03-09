<?php

namespace Convenia\TextMap;

use Convenia\TextMap\Exceptions\FieldNotFoundException;

class Mapable
{
    protected $fields = [];
    protected $fileReader;
    protected $map = [];

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
        foreach ($this->getFields() as $field) {
            $this->map[$field->getName()] = $field
                ->parseString($line)
                ->getFormated();
        }
    }
}
