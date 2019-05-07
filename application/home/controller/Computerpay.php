<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/29
 * Time: 14:35
 */
namespace app\home\controller;

use think\Config;
use think\Controller;

vendor('alipay/service/AlipayTradeService');
vendor('alipay/buildermodel/AlipayTradePagePayContentBuilder');
vendor('alipay/buildermodel/AlipayTradeQueryContentBuilder');
vendor('alipay/buildermodel/AlipayTradeRefundContentBuilder');
vendor('alipay/buildermodel/AlipayTradeFastpayRefundQueryContentBuilder');
vendor('alipay/buildermodel/AlipayTradeCloseContentBuilder');

class Computerpay extends Controller{


    public function index(){
        return $this->fetch();
    }


    public function pay(){
        return $this->fetch();
    }

    public function pagepay(){
        //商户订单号，商户网站订单系统中唯一订单号，必填
        //$out_trade_no = trim($_POST['WIDout_trade_no']);
        //123456789
        $out_trade_no = trim($_REQUEST['WIDout_trade_no']);

        //订单名称，必填
        $subject = trim($_REQUEST['WIDsubject']);

        //付款金额，必填
        $total_amount = trim($_REQUEST['WIDtotal_amount']);

        //商品描述，可空
        $body = trim($_REQUEST['WIDbody']);

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        //$aop = new AlipayTradeService($config);
        $aop = new \AlipayTradeService(Config::get('alipayArr'));

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,Config::get('alipayArr')['return_url'],Config::get('alipayArr')['notify_url']);

        //输出表单
        var_dump($response);
    }


    //交易查询
    public function query(){
        //商户订单号，商户网站订单系统中唯一订单号
        $out_trade_no = trim($_REQUEST['WIDTQout_trade_no']);

        //支付宝交易号
        $trade_no = trim($_REQUEST['WIDTQtrade_no']);
        //请二选一设置
        //构造参数
        $RequestBuilder = new \AlipayTradeQueryContentBuilder();
        $RequestBuilder->setOutTradeNo($out_trade_no);
        $RequestBuilder->setTradeNo($trade_no);


        $aop = new \AlipayTradeService(Config::get('alipayArr'));


        /**
         * alipay.trade.query (统一收单线下交易查询)
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @return $response 支付宝返回的信息
         */
        $response = $aop->Query($RequestBuilder);
        var_dump($response);
    }

    //电脑支付退款接口
    public function refund(){
        //商户订单号，商户网站订单系统中唯一订单号
        $out_trade_no = trim($_REQUEST['WIDTRout_trade_no']);

        //支付宝交易号
        $trade_no = trim($_REQUEST['WIDTRtrade_no']);
        //请二选一设置

        //需要退款的金额，该金额不能大于订单金额，必填
        $refund_amount = trim($_REQUEST['WIDTRrefund_amount']);

        //退款的原因说明
        $refund_reason = trim($_REQUEST['WIDTRrefund_reason']);

        //标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传
        $out_request_no = trim($_REQUEST['WIDTRout_request_no']);

        //构造参数
        $RequestBuilder=new \AlipayTradeRefundContentBuilder();
        $RequestBuilder->setOutTradeNo($out_trade_no);
        $RequestBuilder->setTradeNo($trade_no);
        $RequestBuilder->setRefundAmount($refund_amount);
        $RequestBuilder->setOutRequestNo($out_request_no);
        $RequestBuilder->setRefundReason($refund_reason);

        $aop = new \AlipayTradeService(Config::get('alipayArr'));

        /**
         * alipay.trade.refund (统一收单交易退款接口)
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @return $response 支付宝返回的信息
         */
        $response = $aop->Refund($RequestBuilder);
        var_dump($response);
    }

    //电脑支付退款查询
    public function refundquery(){
//商户订单号，商户网站订单系统中唯一订单号
        $out_trade_no = trim($_REQUEST['WIDRQout_trade_no']);

        //支付宝交易号
        $trade_no = trim($_REQUEST['WIDRQtrade_no']);
        //请二选一设置

        //请求退款接口时，传入的退款请求号，如果在退款请求时未传入，则该值为创建交易时的外部交易号，必填
        $out_request_no = trim($_REQUEST['WIDRQout_request_no']);

        //构造参数
        $RequestBuilder=new \AlipayTradeFastpayRefundQueryContentBuilder();
        $RequestBuilder->setOutTradeNo($out_trade_no);
        $RequestBuilder->setTradeNo($trade_no);
        $RequestBuilder->setOutRequestNo($out_request_no);

        $aop = new \AlipayTradeService(Config::get('alipayArr'));

        /**
         * 退款查询   alipay.trade.fastpay.refund.query (统一收单交易退款查询)
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @return $response 支付宝返回的信息
         */
        $response = $aop->refundQuery($RequestBuilder);
        var_dump($response);
    }

    //电脑支付交易关闭
    //用于交易创建后，用户在一定时间内未进行支付，可调用该接口直接将未付款的交易进行关闭。
    public function close(){
        //商户订单号，商户网站订单系统中唯一订单号
        $out_trade_no = trim($_REQUEST['WIDTCout_trade_no']);

        //支付宝交易号
        $trade_no = trim($_REQUEST['WIDTCtrade_no']);
        //请二选一设置

        //构造参数
        $RequestBuilder=new \AlipayTradeCloseContentBuilder();
        $RequestBuilder->setOutTradeNo($out_trade_no);
        $RequestBuilder->setTradeNo($trade_no);

        $aop = new \AlipayTradeService(Config::get('alipayArr'));

        /**
         * alipay.trade.close (统一收单交易关闭接口)
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @return $response 支付宝返回的信息
         */
        $response = $aop->Close($RequestBuilder);
        var_dump($response);
    }



    //支付宝电脑支付异步返回
    public function notifyUrl(){
        /* *
         * 功能：支付宝服务器异步通知页面
         * 版本：2.0
         * 修改日期：2017-05-01
         * 说明：
         * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

         *************************页面功能说明*************************
         * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
         * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
         * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
         */

        $arr=$_REQUEST;
        $alipaySevice = new \AlipayTradeService(Config::get('alipayArr'));
        $alipaySevice->writeLog(var_export($_REQUEST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

            $out_trade_no = $_REQUEST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_REQUEST['trade_no'];

            //交易状态
            $trade_status = $_REQUEST['trade_status'];


            if($_REQUEST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                $alipaySevice->writeLog('交易已经结束');
                $sql = "update user set account=account+'".$total_amount."' where id='".$_SESSION['uid']."'";
                M('user')->execute($sql);

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_REQUEST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
                $sql = "update user set account=account+'".$total_amount."' where id='".$_SESSION['uid']."'";
                M('user')->execute($sql);
                $alipaySevice->writeLog('交易成功');
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";	//请不要修改或删除
        }else {
            //验证失败
            echo "fail";

        }
    }

    //支付宝电脑支付同步返回
    public function returnUrl(){
        /* *
         * 功能：支付宝页面跳转同步通知页面
         * 版本：2.0
         * 修改日期：2017-05-01
         * 说明：
         * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

         *************************页面功能说明*************************
         * 该页面可在本机电脑测试
         * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
         */


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService(Config::get('alipayArr'));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);

            echo "验证成功<br />支付宝交易号：".$trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }
}