<?php

namespace Convenia\TextMap;


use Convenia\TextMap\Exceptions\FileNotFoundException;

class FileReader
{
    protected $lines = [];

    /**
     * @param string $file
     * @return FileReader
     * @throws FileNotFoundException
     */
    public function read(string $file)
    {
        $file = $this->openFile($file);
        $this->lines = $this->parseLines($file);
        fclose($file);

        return $this;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @param resource $file
     * @return array
     */
    private function parseLines($file)
    {
        $lines = [];
        while ($line = fgets($file)) {
            $lines[] = $line;
        }

        return $lines;
    }

    /**
     * @param string $file
     * @return bool|resource
     * @throws FileNotFoundException
     */
    private function openFile(string $file)
    {
        $file = @fopen($file, 'r');
        if (is_bool($file)) {
            throw new FileNotFoundException();
        }

        return $file;
    }
}