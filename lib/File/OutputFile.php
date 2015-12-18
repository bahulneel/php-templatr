<?php
namespace Templatr\File;

class OutputFile implements Writable
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var resource
     */
    private $fileHandle;

    /**
     * OutputFile constructor.
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        if (empty($fileName)) {
            throw new \InvalidArgumentException('No output file specified');
        }
        $baseDir = dirname($fileName);
        if (!is_writable($baseDir)) {
            throw new NotWritable($baseDir . ' is not writable');
        }
        if (file_exists($fileName) && !is_writable($fileName)) {
            throw new NotWritable($fileName . ' is not writable');
        }

        $this->fileName = $fileName;
    }

    /**
     * @param string $string
     * @return int
     */
    public function write($string)
    {
        if (!$this->fileHandle) {
            $this->fileHandle = fopen($this->fileName, 'w');
        }
        return fputs($this->fileHandle, $string);
    }
}
