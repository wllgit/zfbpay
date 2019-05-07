<?php
//配置文件
return [
    //模板参数替换
    'view_replace_str'       => array(
        '__CSS__'    => '/static/admin/css',
        '__JS__'     => '/static/admin/js',
        '__IMG__' => '/static/admin/images',
        '__BOOT__' => 'FlatLabBootstrap3/admin/template',
        '__FILE_UPLOAD__' => '/file_upload',
        '__URL__' => 'http://www.zt.com/index.php/home/',
        '__P__' => '/static/admin/v2/pages-v2',
    ),


    // 默认操作名
    'default_action'         => 'login',


    /*
     * 支付宝支付配置
     */
    'alipayArr' => array(
        //应用ID,您的APPID。
        'app_id' => "2016093000628247",

        //商户私钥
        'merchant_private_key' => "MIIEpAIBAAKCAQEAxLekeHTDHtjXYQEbQUXKAk2h3ShOInOe9pLTod+JvnuDdEW2FNa4KQZhvfLjEzeKzd3UNC6eWlxFnTqtnj7F9BnGxLRBCfxda/x7Z5Gbh3zoMoe74ux0u9uEDvHuQ7SxDPJgLh259RLKqoTG35AHwxBjORB8kI3KVtQvFxAcnkGac3p8UO8WjOcOpcdEC/TE0FhOyi9mcIpsSNsOShyMgzL7X5oJ3ydu17hwqTTVon8iQiDqGiIPiEnVET7Ug9LoUGT4Sryt7RZ2oS3Ode+ArvwHCjMWs2jFtjbMpzEj53nSirTWWTiyPVTOLW513b/OsxPxQpHD8fd/VL+RPZiYJwIDAQABAoIBABmxotnY5mNxDzCsZFLyOqByY2HvkcUONQUfyGSsPeGTYGgfctjl8sfo/XtB7kbkSkz5XG40aJqE0tLmhybULCbl9wBaSuRzAgDIyZWNfzMDLZDsCa5qFBU1ZtpM30IYp8d5IPblCxTnj3EWRqOMvHbN/SfG734yBuuwazYn9JT24bfhNnEtAM4p/IjBdJDH6YOHlxpjWYlfCy+Y6XDaXs+2B6BMvs9bCJNiy22jKiEdCHkr3ltWaR/oq6qyvTDI0KbA888BWwAD+oKlCZd6sPFFhGzWEUYU5FAjHB56CqV1bjAAnq1mQ4wBA/fV3h2QKI/KIEnUlBOeYkye+OPLv4ECgYEA+IkNyxGtfn7m8g2LjJwPYJheDVtvCD+BKhMOMtfB6KGE/KUbYQgn3LS/EwZsY0WcaEm6X9OVayvU2hDK+6cJfCQCoKfHAsGNFVLBYRqPo8oPjf7GRjNoiBT1D6XmC6ESifFTjwlE2SRtkP++mysavsKiTV67ZH7dl6JszPk31csCgYEAyqArL/q6Hi43TFz1dNuqOj8fQs8YxiAIKlNYT25pe906dLrXsCJOw/LImAAiLF+K35YtX3kg2FREyKh0kXW6i8SALBgJ8fKgCJW7+LS6DGMORrszc06H00BgeX0Ks83RZw+bN5S1nTdkISkWE4mLhLIobTjdnO57V9Do2jIOW5UCgYEAuDyw8uYp3GmqPaj418UgSRTqM7CiAFVDJLN3hQ0X+6EwejDSuP1Yv21lb28FjhmeNljhRgQM8aNOaFCmiCJtD4+KOxnklxBvy2zLWXZdIKe7HCHPTV7ykF4ow+7RN7GxknxI2vGeDfHJHwHWhCRR8TNLKVueQoMhNTT8vn3IfD0CgYAo345Wq1kH5YK6ILZS0EzSWxFPRL9Wl/eNsipKO5eDqOi1y0re+MyysjLMlppOISe+WmjkrWZ2vOjzISgCf6EVuJmyS1cWOz8U/D9it/IftYuXsQN76wdzEbVkTFjwVEA9beR9nb3U7OuB1OvjHQfLyLRm8+WgVmsDF90gxqAm0QKBgQCEQP/X+vYpKbvK5vAnGblOTHgaD1VcMt3HFI3qgF0SBWCJUVd2k35C7azah96UPzH/5SLt7m7o5yXi+Inm2HJRyFJcwAVm1JmRVYQOcvmrG3Jcd2XzZv/kZ3az0I0rH0wfz+j5BzyOW/MALbWR2T1XoTdhnn2eA1QaduWrQTUgrw==",

        //异步通知地址
//        'notify_url' => "https://fire.zt-ioe.com/tp5/public/index.php/api/pay/callBack",
        'notify_url' => "http://www.zt.com/index.php/home/Computerpay/notifyUrl",

        //同步跳转
//        'return_url' => "https://fire.zt-ioe.com/tp5/public/index.php/api/pay/index",
        'return_url' => "http://www.zt.com/index.php/home/Computerpay/returnUrl",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzncZa4pVX43ySrhwM5/hGUszJOMIGOUMuV+72sa/4w4XZ1r50DLnkCoLSiD4+n/yUvpi41w238H5RiUceTH/avvm1BN/15Zd2GV9dUDvfipxWoW2gS3Gjt7Jxdt6TGXy26RmFoHOEgTg45sNMWSwtLZb06haW6FliJKWARRtqE2MqQ7V4SmgyJuyI4LEVJ4Zrov1YYap9NH7PazZY2oQf9m9BR5F/wEKL5CnWSB33g4DufzsM6f8jXO4EuV2uJtUA6fCht0chd+Sk2kt9J1ZGzHI2ZOMLACiGFvftS81eiQUl96WAx8hbKL2ad8qK4aJMVeKZIRTneQMGlQVQHdfwwIDAQAB",

    ),

];