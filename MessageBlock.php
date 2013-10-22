<?php

require_once dirname(__FILE__) . "/Field.php";

class MessageBlock
{
    const
        TYPE_REQUEST = "request",
        TYPE_ENUM = "enum",
        TYPE_MESS = "message",
        TYPE_RESPONSE = "response",
        TYPE_DATA = "data";

    public $mess_name;
    public $mess_type;
    public $fields;

    public function __construct($name, $type, $str_fields)
    {
        $this->mess_name = $name;
        $this->mess_type = $type;
        $this->fields = Field::createFieldsFromStr($str_fields, $type);
    }
}
