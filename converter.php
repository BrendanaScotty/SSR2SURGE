<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 03/05/2017
 * Time: 09:54
 */


$surge_module = "https://lonelydog.in/downloads/SSEncrypt.module";
$ssr_config =  json_decode(file_get_contents('gui-config.json'),true);

if (isset($ssr_config) && is_array($ssr_config) && is_array($ssr_config['configs'])) {
    $surge_config = "[Proxy]".PHP_EOL;
    $surge_proxy_groups = "[Proxy Group]".PHP_EOL."group1 = url-test,";

    foreach ($ssr_config['configs'] as $v){

//        print_r($v); break;
        $server_name = explode(" ",$v['remarks']);
        $row = "{$server_name[0]} = custom, {$v['server']}, {$v['server_port']}, {$v['method']}, {$v['password']}, {$surge_module} ".PHP_EOL;
        $surge_config .= $row;

        $surge_proxy_groups .= "{$server_name[0]},";
    }
    $surge_proxy_groups .= "url = http://www.youtube.com";

    $output = $surge_config.$surge_proxy_groups;

    file_put_contents("surge_config.conf",$output);
}