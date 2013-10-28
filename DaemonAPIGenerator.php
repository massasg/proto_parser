<?php

class DaemonAPIGenerator extends ClassGenerator
{
    const
        FILE_HEADER = "<?php\n/**\n*@team QA <qa@copr.badoo.com>\n*/\n\nrequre_once __DIR__ . '../BadooCDaemonsAPI.php';\n\n",
        FILE_NAME = "DaemonAPI.php";

    private
        $daemon_name,
        $proto_file;
    public
        $file_name;

    public function __construct($proto_file)
    {
        $this->proto_file = $proto_file;
        $this->daemon_name = Helper::getDaemonName($proto_file->package_name);
        $this->file_name = $this->daemon_name + self::FILE_NAME;
    }

    public function getDaemonName()
    {
        return $this->daemon_name;
    }

    public function generateAPIFile()
    {
        
    }
}
