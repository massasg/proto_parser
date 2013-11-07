<?php

require_once __DIR__ . "/MessageParser.php";

class ProtoFileParser
{
    const
        REG_PACKAGE = "/package (.*);/",
        REG_ENUM = "/enum (.*) {(.*)}/Us",
        REG_REQUEST = "/message request_(.*) {(.*)}/Us",
        REG_RESPONSE = "/message response_(.*) {(.*)}/Us";

    public $file_name;
    public $package_name;
    public $requests;
    public $responses;
    public $enums;
    private $file_content;

    public function __construct($proto_name)
    {
        $this->file_name = $proto_name;
        if (!file_exists($this->file_name)) {
            return;
        }

        $this->file_content = file_get_contents($this->file_name);
        $this->parseContent();
    }

    public function parseContent()
    {
        $this->findPackageName();

        $this->findRequests();
        $this->findResponses();
        $this->findEnums();
    }

    public function findPackageName()
    {
        preg_match_all(self::REG_PACKAGE, $this->file_content, $result);
        $this->package_name = $result[1][0];
    }

    public function findRequests()
    {
        preg_match_all(self::REG_REQUEST, $this->file_content, $result);
        for ($i = 0; $i < count($result[1]); $i++) {
            $this->requests[] = new MessageParser($result[1][$i], MessageParser::TYPE_REQUEST, $result[2][$i]);
        }
    }

    public function findResponses()
    {
        preg_match_all(self::REG_RESPONSE, $this->file_content, $result);
        for ($i = 0; $i< count($result[1]); $i++) {
            $this->responses[] = new MessageParser($result[1][$i], MessageParser::TYPE_RESPONSE, $result[2][$i]);
        }
    }

    public function findEnums()
    {
        preg_match_all(self::REG_ENUM, $this->file_content, $result);
        for ($i = 0; $i< count($result[1]); $i++) {
            $this->enums[] = new MessageParser($result[1][$i], MessageParser::TYPE_ENUM, $result[2][$i]);
        }

    }
}
