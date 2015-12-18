#!/usr/bin/env php
<?php
require_once __DIR__ . "/../vendor/autoload.php";

$arguments = new \cli\Arguments();

$arguments->addFlag(array('help', 'h'), 'Show this help screen');

$arguments->addOption(['template', 't'], [
    'description' => 'Input template'
]);

$arguments->addOption(['context', 'c'], [
    'description' => 'Input context'
]);

$arguments->addOption(['write', 'w'], [
    'description' => 'Write output to file'
]);


$arguments->parse();

if ($arguments['help']) {
    echo $arguments->getHelpScreen();
    echo "\n\n";
    exit;
}

$templatr = \Templatr\Templatr::fromArray($arguments);
$templatr->render();
