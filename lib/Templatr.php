<?php
namespace Templatr;

use Templatr\File\InputFile;
use Templatr\File\JsonInputFile;
use Templatr\File\OutputFile;
use Templatr\File\Readable;
use Templatr\File\Stdout;
use Templatr\File\Writable;

class Templatr
{
    /**
     * @var Readable
     */
    private $template;

    /**
     * @var \ArrayAccess
     */
    private $context;

    /**
     * @var Writable
     */
    private $output;

    public function __construct(Readable $template, \ArrayAccess $context, Writable $output)
    {
        $this->template = $template;
        $this->context = $context;
        $this->output = $output;
    }

    /**
     * @param \ArrayAccess $config
     * @return Templatr
     */
    static function fromArray(\ArrayAccess $config)
    {
        $template = new InputFile($config['template']);
        $context = new JsonInputFile($config['context']);
        if (!isset($config['write'])) {
            $output = new Stdout();
        } else {
            $output = new OutputFile($config['write']);
        }
        return new Templatr($template, $context, $output);
    }

    public function render()
    {
        $m = new \Mustache_Engine();
        $template = $this->template->contents();
        $output = $m->render($template, $this->context);
        $this->output->write($output);
    }
}
