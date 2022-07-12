<?php

class SaxParser
{
    private string $file;
    private XMLParser $parser;

    public function __construct(string $file)
    {
        $this->file = $file;
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);
        xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, true);

        xml_set_element_handler($this->parser, "startElementHandler", "endElementHandler");
        xml_set_character_data_handler($this->parser, "characterDataHandler");
    }

    public function parse(): void
    {
        if (!$oHandle = fopen($this->file, "r")) {
            echo "File could not be opened: " . $this->file . "!<br>";
            return;
        }

        while ($data = fread($oHandle, filesize($this->file))) {
            if (!xml_parse($this->parser, $data, feof($oHandle))) {
                $iLine = xml_get_current_line_number($this->parser);
                $iErrorCode = xml_get_error_code($this->parser);
                $sErrorText = xml_error_string($iErrorCode);
                echo "<b>Error at line " . $iLine . ", code: " . $iErrorCode .
                    ", message: " . $sErrorText . "</b><br>";
            }
        }

        fclose($oHandle);
        xml_parser_free($this->parser);
    }

    function startElementHandler(XMLParser $XMLParser, string $elem, array $attr): void
    {
        switch ($elem) {
            case "Person":
                echo "<b>Person <i>" . $attr['id'] . "</i></b><br>";
                echo "<b>Geschlecht:</b> " . $attr['geschlecht'] . "<br>";
                break;
            case "Name":
                echo "<b>Name: ";
                break;
            case "Interessen":
                echo "<b>Hobbies:</b> ";
                break;
            default:
                break;
        }
    }

    function endElementHandler(XMLParser $XMLParser, string $elem): void
    {
        switch ($elem) {
            case "Vorname":
            case "Hobby":
                echo " ";
                break;
            case "Person":
            case "Interessen":
                echo "<br>";
                break;
            case "Name":
                echo "</b><br>";
                break;
            default:
                break;
        }
    }

    function characterDataHandler(XMLParser $oXMLParser, string $data): void
    {
        echo trim($data);
    }
}

