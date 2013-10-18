<?php

ProtoParser::mainCircle();

class ProtoParser
{
    public static function mainCircle
    {
        $proto_dir = dirname(__FILE__) . "/proto";
        $proto_files = self::findProtoFilesIn($proto_dir);
        foreach ($proto_files as $proto_name) {
            $proto_file = self::parseProtoFile();
        }
    }

    public static function findProtoFilesIn($dir_name)
    {
        $result = array();
        if (!file_exists($dir_name)){
            return $result;
        }
        $all_files = scandir($dir_name);
        foreach ($all_files as $file_name) {
            if (!stripos($file_name, "proto")) {
                continue;
            }
            $result[] = $file_name;
        }

        return $result;
    }

    public static function parseProtoFile($proto_name)
    {
        $proto_file = new ProtoFile($proto_name);

        return $proto_file;
    }
}
