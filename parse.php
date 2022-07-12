<?php
spl_autoload_register('autoload');
function autoload($sClassName): void
{
    require_once("$sClassName.php");
}

$domParser = new DomParser("person.xml");
if ($domParser->load()) {
    $domParser->output();
} else {
    echo "Document could not be loaded!";
}

$oSaxParser = new SaxParser("person.xml");
$oSaxParser->parse();