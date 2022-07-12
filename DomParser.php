<?php

class DomParser
{
    private string $filename;
    private DomDocument $doc;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->doc = new DOMDocument();
    }

    public function load(): bool
    {
        return ($this->doc->load($this->filename));
    }

    public function output(): void
    {
        $persons = $this->doc->getElementsByTagName('Person');
        foreach ($persons as $person) {
            $id = $person->hasAttribute('id') ? $person->getAttribute('id') : '';
            $geschlecht = $person->hasAttribute('id') ? $person->getAttribute('geschlecht') : '';
            $res = "<b>Person: <i>$id</i></b><br>";
            $res .= "<b>Geschlecht: </b>$geschlecht<br>";
            $res .= "<b>Name: ";
            $res .= getFirstDescendant('Vorname', $person)->nodeValue . " ";
            $res .= getFirstDescendant('Nachname', $person)->nodeValue . "</b><br>";
            $res .= "<b>Hobbies:</b> ";
            $hobbies = $person->getElementsByTagName('Hobby');
            foreach ($hobbies as $hobby) {
                $res .= "$hobby->nodeValue ";
            }
            $res .= "<br><br>";
            echo $res;
        }
    }
}

function getChildNode(string $tagName, $node)
{
    foreach ($node->childNodes as $child) {
        if ($child->nodeName == $tagName) {
            return $child;
        }
    }
}

function getFirstDescendant(string $tagName, $node)
{
    return $node->getElementsByTagName($tagName)->item(0);
}

function forEachElement($baseElement, string $tagName, callable $callback): string
{
    $elems = $baseElement->getElementsByTagName($tagName);
    $res = '';
    $counter = 0;
    foreach ($elems as $elem) {
        $counter++;
        $res .= $callback($elem, $counter);
    }
    return $res;
}

/*
forEachElement($this->doc, 'tagName', function ($tagName, $counter) {
    return $counter . " " . getFirstDescendant($tagName)->nodeValue;
});
*/

// $node->hasAttribute(...)
// $node->getAttribute(...)
// $node->nodeValue
// $node->nodeName
// $node->childNodes
// $node->firstChild / $node->lastChild
// $node->nextSibling / $node->previousSibling
// $node->parentNode
// $nodeList->item(...)
// $nodeList->count()
// $nodeList = $doc / $node->getElementsByTagName('tagName')
