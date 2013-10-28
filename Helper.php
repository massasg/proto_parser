<?php

class Helper
{
    public static function getDaemonName($package_name)
    {
        $daemon_name = $package_name;
        $badoo_name = stripos($package_name, ".");
        if ($badoo_name) {
            $daemon_name = substr($package_name, $badoo_name + 1);
        }

        return ucfirst($daemon_name);
    }
}
