<?php
namespace common\components\alidayuSms;
include "TopSdk.php";

class smsService {
    private $appkey="24445262";
    private $secretKey="c4d253919f59ce113a4e235a41c52e9f";
    private $format="json";

    public function __construct() {
        date_default_timezone_set('Asia/Shanghai');
    }

    public function sendMsg($param) {      
        //{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = $this->appkey;
        $c->secretKey = $this->secretKey;
        $c->format = $this->format;
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsTemplateCode('SMS_71371004');
        $req->setRecNum('18168736275');
        $smsParams = ["number" => 123];
        $req->setSmsParam(json_encode($smsParams));
        $req->setSmsFreeSignName('寰宇科技');
        $req->setSmsType('normal');
        $req->setExtend('demo');
        var_dump($c->execute($req));
    }

}

?>