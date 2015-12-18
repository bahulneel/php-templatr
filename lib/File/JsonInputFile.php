<?php
namespace Templatr\File;

class JsonInputFile implements \ArrayAccess
{
    /**
     * @var array
     */
    private $json;

    /**
     * @var InputFile
     */
    private $jsonFile;

    public function __construct($fileName)
    {
        $this->jsonFile = new InputFile($fileName);
    }

    private function init()
    {
        if ($this->json) {
            return;
        }
        $jsonString = $this->jsonFile->contents();
        $json = json_decode($jsonString, true);
        if (!$json) {
            throw new \RuntimeException('Unable to parse json');
        }
        $this->json = $json;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        $this->init();
        return isset($this->json[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->json[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        throw new Immutable('JSON inputs are immutable');
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        throw new Immutable('JSON inputs are immutable');
    }

}