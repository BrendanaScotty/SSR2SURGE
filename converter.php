<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 03/05/2017
 * Time: 09:54
 */


$surge_module = "https://lonelydog.in/downloads/SSEncrypt.module";
$ssr_config = json_decode(file_get_contents('gui-config.json'), true);
const PROXY_GROUP_SECTION = "[Proxy Group]";
const PROXY_SECTION = "[Proxy]";
const PROXY_GROUP_NAME = "LonelyDog";
const TEST_SERVER = "url = http://www.gstatic.com/generate_204";

if (isset($ssr_config) && is_array($ssr_config) && is_array($ssr_config['configs'])) {
    $surge_config = "";

    $server_list = array();

    foreach ($ssr_config['configs'] as $v) {

//        print_r($v); break;
        $server_name = explode(" ", $v['remarks']);
        $row = "{$server_name[0]} = custom, {$v['server']}, {$v['server_port']}, {$v['method']}, {$v['password']}, {$surge_module}" . PHP_EOL;
        $surge_config .= $row;

        $server_list[] = "{$server_name[0]}";
    }

    $default_proxy = "Proxy = select, ".implode(",",$server_list).",".PROXY_GROUP_NAME;
    $proxy_group = PROXY_GROUP_NAME." = url-test,".implode(",",$server_list).",".TEST_SERVER;
    $surge_str = PROXY_SECTION.PHP_EOL.$surge_config.PROXY_GROUP_SECTION.PHP_EOL.$default_proxy.PHP_EOL.$proxy_group.PHP_EOL;

    file_put_contents("surge_config.conf", $surge_str);
}


