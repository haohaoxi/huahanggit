<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 
//{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
    $c = new TopClient;
    $c->appkey = '24445262';
    $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
    $c->format = 'json';
    // $req = new TradeVoucherUploadRequest;
    // $req->setFileName("example");
    // $req->setFileData("@/Users/xt/Downloads/1.jpg");
    // $req->setSellerNick("奥利奥官方旗舰店");
    // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
    // var_dump($c->execute($req));

    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $req->setSmsTemplateCode('SMS_71371004');
    $req->setRecNum('18168736275');
	$smsParams=["number"=>123];
    $req->setSmsParam(json_encode($smsParams));
    $req->setSmsFreeSignName('寰宇科技');
    $req->setSmsType('normal');
    $req->setExtend('demo');
    var_dump($c->execute($req));
?>