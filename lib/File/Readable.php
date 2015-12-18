<?php
namespace Templatr\File;

interface Readable
{
    public function read($length = null);

    public function contents();
}
