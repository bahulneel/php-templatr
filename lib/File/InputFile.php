<?php
namespace Templatr\File;

class InputFile implements Readable
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
     * @var string
     */
    private $contents;

    /**
     * InputFile constructor.
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        if (empty($fileName)) {
            throw new \InvalidArgumentException('No input file specified');
        }
        if (!is_readable($fileName)) {
            throw new NotReadable("Cannot read " . $fileName);
        }
        $this->fileName = $fileName;
    }

    /**
     * @param null|integer $length
     * @return string
     */
    public function read($length = null)
    {
        if (!$this->fileHandle) {
            $this->fileHandle = fopen($this->fileName, 'r');
        }
        if ($length) {
            return fgets($this->fileHandle);
        }
        return fgets($this->fileHandle, $length);
    }

    public function contents()
    {
        if ($this->contents) {
            return $this->contents;
        }

        $this->contents = file_get_contents($this->fileName);
        return $this->contents;
    }
}
