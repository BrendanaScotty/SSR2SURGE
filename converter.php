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

    foreach ($ssr_config['configs'] as $v){
        $row = "{$v['remarks']} = custom, {$v['server_port']}, {$v['method']}, {$v['password']}, {$surge_module} ".PHP_EOL;
        $surge_config .= $row;
    }

    file_put_contents("surge_config",$surge_config);
}