<?php

class Field
{
    const
        //field_type
        FIELD_ENUM = "enum",
        FIELD_MESS = "message",
        //field_param
        PARAM_OPT = "optional",
        PARAM_REQ = "required",
        PARAM_REP = "repeated",
        //value_type
        VALUE_NONE = "none",
        VALUE_UINT32 = "uint32",
        VALUE_STR = "string",
        VALUE_BYTES = "bytes",
        VALUE_BOOL = "bool",
        VALUE_SINT32 = "sint32",
        //reg_exp
        REG_MESS_FIELD = "/(optional|required|repeated) (uint32|string|bytes|bool|sint32) (.*) = [0-9]*/U",
        REG_ENUM_FIELD = "/(.*) = [0-9]*/U";

    public $name;
    public $field_type;
    public $field_param;
    public $value_type;

    public function __construct($field_type, $name, $field_param = "", $value_type = "")
    {
        $this->name = $name;
        $this->field_type = $field_type;
        $this->field_param = $field_param;
        $this->value_type = $value_type;
    }

    public static function createFieldsFromStr($str, $type)
    {
        $result = ($type == MessageBlock::TYPE_ENUM) ?
            self::createEnumFieldsFromStr($str) :
            self::createMessFieldsFromStr($str);
        return $result;
    }

    public static function createMessFieldsFromStr($str)
    {
        $fields = array();
        $result = array();
        preg_match_all(self::REG_MESS_FIELD, $str, $fields);
        for ($i = 0; $i < count($fields[1]); $i++) {
            $result[] = new Field(self::FIELD_MESS, trim($fields[3][$i]), $fields[1][$i], $fields[2][$i]);
        }
        return $result;
    }

    public static function createEnumFieldsFromStr($str)
    {
        $fields = array();
        $result = array();
        preg_match_all(self::REG_ENUM_FIELD, $str, $fields);
        for ($i = 0; $i < count($fields[1]); $i++) {
            $result[] = new Field(self::FIELD_ENUM, trim($fields[1][$i]));
        }
        return $result;
    }
}
