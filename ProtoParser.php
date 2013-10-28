<?php

require_once dirname(__FILE__) . "/ProtoFile.php";
require_once __DIR__ . "/DaemonAPIGenerator.php";
require_once __DIR__ . "/DaemonTestCaseGenerator.php";
require_once __DIR__ . "/Helper.php";

ProtoParser::mainCircle();

class ProtoParser
{
    public static function mainCircle()
    {
        $proto_dir = dirname(__FILE__) . "/proto";
        $proto_files = self::findProtoFilesIn($proto_dir);
        foreach ($proto_files as $proto_name) {
           $proto_file = self::parseProtoFile(dirname(__FILE__) . "/proto/" . $proto_name);
           $api_file = new DaemonAPIGenerator($proto_file);
           var_dump($proto_file->file_name);
           var_dump($api_file->getDaemonName());
    //       var_dump($proto_file->enums);
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
