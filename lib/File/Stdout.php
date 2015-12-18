<?php
namespace Templatr\File;

class Stdout implements Writable
{
    public function write($string)
    {
        echo $string;
    }
}
