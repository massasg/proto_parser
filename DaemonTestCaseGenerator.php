<?php

class DaemonTestCaseGenerator extends ClassGenerator
{
    const
        FILE_HEADER = "<?php\n/**\n*@team QA <qa@copr.badoo.com>\n*/\n\nrequre_once __DIR__ . '../BadooCDaemonsTestCase\n",
        FILE_NAME = "DaemonTestCase.php";

    private
        $daemon_name;

    public
        $file_name;

    public function __construct($proto_file)
    {
        $this->daemon_name = Helper::getDaemonName($proto_file->package_name);
        $this->file_name = $this->daemon_name + self::FILE_NAME;
    }

    public function getDaemonName()
    {
        return $this->daemon_name;
    }

}
