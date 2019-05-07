<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use \think\Config;
use \think\Hook;
// 应用公共文件
require_once APP_PATH.'common/apiLang/apiLang.php';//引入api语言包



/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else{
        return $output;
    }

}



/**
 * 返回ajax请求及状态
 * @param data 返回的数据
 */
function apiResponse($response,$type = 'JSON',$is_quit = false,$is_unicode = false) {
    if(isset($response['data']) && empty($response['data']) && $response['code'] != -100) {
        $msg = NULL_MESSAGE;
        if($is_unicode) {
            $msg = unicode_encode(NULL_MESSAGE);
        }
        $response = ['status' => SUCCESS_STATUS,'msg' => $msg,'code' =>NULL_CODE,'data' => []];
    }
    // 是否进行Unicode编码
    if($is_unicode) {
        $response['msg'] = unicode_encode($response['msg']);
    }
    $token_expired = [401];
    //请求错误
    if($response['code'] < 0){
        header("HTTP/1.0 400 ERROR");
    }
    //token失效
    if(in_array($response['code'], $token_expired)) {
        header("HTTP/1.0 401 ERROR");
    }
    if($is_quit) ajaxReturn($response,$type);
    switch (strtoupper($type)) {
        case 'JSON' :
            // 返回JSON数据格式到客户端 包含状态信息
            return json($response);
            break;
        case 'XML'  :
            // 返回xml格式数据
            return xml($response,200,[],['root_node'=>'root']);
            break;
        case 'JSONP':
            // 返回JSON数据格式到客户端 包含状态信息
            return jsonp($response);
            break;
    }
}


function ajaxReturn($data,$type='JSON') {
    switch (strtoupper($type)){
        case 'JSON' :
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode($data));
        case 'XML'  :
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            $xml = "<root>";
            $xml.=xml_encode($data);
            $xml.="</root>";
            exit($xml);
        case 'JSONP':
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            $handler  =   isset($_GET[Config::get('VAR_JSONP_HANDLER')]) ? $_GET[Config::get('VAR_JSONP_HANDLER')] : Config::get('DEFAULT_JSONP_HANDLER');
            exit($handler.'('.json_encode($data).');');
        case 'EVAL' :
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
        default     :
            // 用于扩展其他返回格式数据
            Hook::listen('ajax_return',$data);
    }
}

/*
 * xml格式
 */
function xml_encode($arr){
    $xml = '';
    foreach ($arr as $key=>$val){
        if(is_array($val)){
            $xml.="<".$key.">".xml_encode($val)."</".$key.">";
        }else{
            $xml.="<".$key.">".$val."</".$key.">";
        }
    }
    return $xml;
}

/**
    内容unicode编码
 */
function unicode_encode($str, $encoding = 'UTF-8', $prefix = '\u', $postfix = ';') {
    $str = iconv($encoding, 'UCS-2', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    }
    return $unistr;
}