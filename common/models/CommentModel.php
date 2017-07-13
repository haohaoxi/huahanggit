<<<<<<< .mine
<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Query;
use yii\imagine\Image;

/**
 * Yii 提供一系列常用的核心验证器，主要存在于 yii\validators 命名空间之下
 */
class CommentModel extends ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        // return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // 检查 "username" 与 "password" 是否为空
            [['username', 'password'], 'required'],
            // 检查 "selected" 是否为 0 或 1，无视数据类型
            ['selected', 'boolean'],
            // 检查 "deleted" 是否为布尔类型，即 true 或 false
            ['deleted', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => true], //strict：是否要求待测输入必须严格匹配 trueValue 或 falseValue。默认为 false。
            //验证码
            ['verificationCode', 'captcha'],
            //['verifyCode', 'captcha','captchaAction'=>'admin/index/captcha','message'=>'验 证码不正确！'], 这种写法在官网自带的LoginForm.php中有写到，大家可以没事看看 ]; 
            // 检查 "password" 特性的值是否与 "password_repeat" 的值相同
            ['password', 'compare'],
            // 检查年龄是否大于等于 30
            ['age', 'compare', 'compareValue' => 30, 'operator' => '>='],
            // 若 "age" 为空，则将其设为 null
            ['age', 'default', 'value' => null],
            // 若 "country" 为空，则将其设为 "USA"
            ['country', 'default', 'value' => 'USA'],
            // 若 "from" 和 "to" 为空，则分别给他们分配自今天起，3 天后和 6 天后的日期。
            [['from', 'to'], 'default', 'value' => function ($model, $attribute) {
                    return date('Y-m-d', strtotime($attribute === 'to' ? '+3 days' : '+6 days '));
                }],
            // 检查 "salary" 是否为浮点数
            ['salary', 'double'],
            // checks if every category ID is an integer
            ['categoryIDs', 'each', 'rule' => ['integer']],
            // 检查 "email" 是否为有效的邮箱地址
            ['email', 'email'],
            // a1 需要在 "a1" 特性所代表的字段内存在
            ['a1', 'exist'],
            // a1 必需存在，但检验的是 a1 的值在字段 a2 中的存在性
            ['a1', 'exist', 'targetAttribute' => 'a2'],
            // a1 和 a2 的值都需要存在，且它们都能收到错误提示
            [['a1', 'a2'], 'exist', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的值都需要存在，只有 a1 能接收到错误信息
            ['a1', 'exist', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a1 的值来确定 a1 的存在性
            ['a1', 'exist', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // a1 必需存在，若 a1 为数组，则其每个子元素都必须存在。
            ['a1', 'exist', 'allowArray' => true],
            // 检查 "primaryImage" 是否为 PNG, JPG 或 GIF 格式的上传图片。
            // 文件大小必须小于  1MB
            ['primaryImage', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024],
            // trim 掉 "username" 和 "email" 输入
            [['username', 'email'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            // 标准化 "phone" 输入
            ['phone', 'filter', 'filter' => function ($value) {
                    // 在此处标准化输入的电话号码
                    return $value;
                }],
            // 检查 "primaryImage" 是否为适当尺寸的有效图片
            ['primaryImage', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 100, 'maxWidth' => 1000,
                'minHeight' => 100, 'maxHeight' => 1000,
            ],
            // 检查 "level" 是否为 1、2 或 3 中的一个
            ['level', 'in', 'range' => [1, 2, 3]],
            // 检查 "age" 是否为整数
            ['age', 'integer'],
            // 检查 "username" 是否由字母开头，且只包含单词字符
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            // 检查 "salary" 是否为数字
            ['salary', 'number'],
            // 标记 "description" 为安全特性
            ['description', 'safe'],
            // 检查 "username" 是否为长度 4 到 24 之间的字符串
            ['username', 'string', 'length' => [4, 24]],
            // a1 需要在 "a1" 特性所代表的字段内唯一
            ['a1', 'unique'],
            // a1 需要唯一，但检验的是 a1 的值在字段 a2 中的唯一性
            ['a1', 'unique', 'targetAttribute' => 'a2'],
            // a1 和 a2 的组合需要唯一，且它们都能收到错误提示
            [['a1', 'a2'], 'unique', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的组合需要唯一，只有 a1 能接收错误提示
            ['a1', 'unique', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a3 的值来确定 a1 的唯一性
            ['a1', 'unique', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // 检查 "website" 是否为有效的 URL。若没有 URI 方案，
            // 则给 "website" 特性加 "http://" 前缀
            ['website', 'url', 'defaultScheme' => 'http'],
            [['pid', 'displayorder'], 'integer', 'on' => ['update', 'register']],
            [['title', 'displayorder', 'type'], 'required', 'on' => ['update', 'register']],
            [['title'], 'string', 'max' => 30, 'unique', 'targetClass' => self::className(), 'message' => '此目录名已经被使用', 'on' => ['update', 'register']],
            [['type'], 'string', 'max' => 15, 'on' => 'register'],
        ];
    }

    //下载文件
    public function actionDownload() {
        return \Yii::$app->response->setDownloadHeaders("http://xxx.com/apk/com.trade.activity.3.0.8.apk");
        //return \Yii::$app->response->sendFile("./com.trade.activity.3.0.8.apk");
    }

    //关联关系查询
    public function getOrders() {
        //客户和订单是一对多的关系所以用hasMany
        //此处OrdersModel在CustomerModel顶部别忘了加对应的命名空间
        //id对应的是OrdersModel的id字段，order_id对应CustomerModel的order_id字段
        return $this->hasMany(OrdersModel::className(), ['id' => 'order_id']);
    }

    public function getCountry() {
        //客户和国家是一对一的关系所以用hasOne
        return $this->hasOne(CountrysModel::className(), ['id' => 'Country_id']);
    }

    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['register'] = ['pid', 'title', 'type'];
        $scenarios['update'] = ['pid', 'title', '

            '];
        return $scenarios;
    }

    //图片水印处理
    function imageshandel() {
        //图片路径请根据自己的项目的位置调整

        Image::frame(Yii::getAlias('@backend') . '/web/uploads/gw-bg.jpg', 5, '666', 0)
                ->rotate(-8)
                ->save(Yii::getAlias('@backend') . '/web/uploads/image.jpg', ['quality' => 50]);
        //生成一个缩略图
        Image::thumbnail(Yii::getAlias('@backend') . '/web/uploads/image.jpg', 200, 200)
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/imagethumb-test-image.jpg'), ['quality' => 80]);


        //裁剪一张图片并存储
        Image::crop(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/image.jpg'), 300, 300, [300, 300])
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/crop-photo.jpg'), ['quality' => 80]);


        // 给一张图片加水印
        Image::watermark(Yii::getAlias('@backend/web/uploads/image.jpg'), Yii::getAlias('@backend/web/uploads/crop-photo.jpg'), [100, 100])
                ->save(Yii::getAlias('@backend/web/uploads/watermark-photo.jpg'), ['quality' => 100]);


        //给图片加文字
        $textOpt = ['color' => '000', 'size' => '32', 'angle' => 0];
        $fontFile = Yii::getAlias('@backend/web/uploads/叶根友刀锋黑草.ttf');
        Image::text(Yii::getAlias('@backend/web/uploads/image.jpg'), '这是一张图片的水印', $fontFile, [800, 850], $textOpt)
                ->save(Yii::getAlias('@backend/web/uploads/text-photo.jpg'), ['quality' => 100]);
    }

    //生成url
    function generateurl() {
        \yii\helpers\Url::toRoute('mysql/view/' . $model->id);
        Yii::$app->urlManager->createUrl(['mysql/chart/', 'server_id' => $model->server_id, 'time_interval' => '1800', 'end' => '0']);
    }

    //条件筛选语句
    function yiiandwhere() {
        //Yii2 获取接口传过来的 JSON 数据
        Yii::$app->request->rawBody;
        // post
        Yii::$app->request->bodyParams;
        // get
        $server_id = Yii::$app->getRequest()->get()['server_id'];
        Yii::$app->request->queryParams;
        $query = new Query;
        $query->select('ID, City,State,StudentName')
                ->from('student')
                ->where(['IsActive' => 1])
                ->andWhere(['not', ['City' => null]])
                ->andWhere(['not', ['State' => null]])
                ->orderBy(['rand()' => SORT_DESC])
                ->limit(10);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->andWhere(['pid' => 0]);
        User::find()->where(['and', ['xxx' => 0, 'yyy' => 2], ['>', 'zzz', $time]]);
        $dataProvider->query->andWhere(['>', 'pid', 0]);
    }

    //事务用法
    function yiitransaction() {
        $connection = new Connection();
        // INSERT
        $connection->createCommand()->insert('user', [
            'name' => 'Sam',
            'age' => 30,
        ])->execute();

        // INSERT 一次插入多行
        $connection->createCommand()->batchInsert('user', ['name', 'age'], [
            ['Tom', 30],
            ['Jane', 20],
            ['Linda', 25],
        ])->execute();

        // UPDATE
        $connection->createCommand()->update('user', ['status' => 1], 'age > 30')->execute();

        // DELETE
        $connection->createCommand()->delete('user', 'status = 0')->execute();


        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            //.... other SQL executions
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        //创建表
        // 创建表
        $connection->createCommand()->createTable('post', [
            'id' => 'pk',
            'title' => 'string',
            'text' => 'text',
        ]);

        //预处理
        $command = $connection->createCommand('SELECT * FROM post WHERE id=:id');
        $command->bindValue(':id', $_GET['id']);
        $post = $command->query();
    }

    //生成表语句
    function generatetabel() {

        echo dirname(Yii::$app->basePath);

        //        $mir = new Migration();
        //        $sch = new \yii\db\mysql\Schema;
        //        $mir->createTable('post', [
        //            'id' => 'pk',
        //            'title' => $sch::TYPE_STRING . ' NOT NULL',
        //            'text' => $sch::TYPE_TEXT,
        //        ]);
        //相当于下面try{}catch{}语句     
        Yii::$app->db->transaction(function() {
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
        });
        // 在主服务器连接上开始事务
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();


        try {
            // 所有的查询都在主服务器上执行
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
            $db->createCommand("UPDATE post SET title='demo' WHERE id=1")->execute();
//            $model = new MerchantInfo();
//            if (!$model->save()) {
//                $error = array_values($model->getFirstErrors())[0];
//                throw new Exception($error); //抛出异常
//            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'name',
                'value' => 'Larry',
                'expire' => time() + 3600
            ]));
            throw $e;
        }
    }

    //发送邮件
    function sendEmail() {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
        $mail->setSubject("邮件主题"); //邮件主题 
        $mail->setTextBody('测试text'); //发布纯文字文本 
        $mail->setHtmlBody("测试html text"); //发送的消息内容 
        var_dump($mail->send());
        exit;
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
        //{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

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

    //session相关操作
    public function aboutSession() {

        //检查session是否打开
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        } else {
            echo "有session";
            Yii::$app->session->set('login_sms_time', time());
            Yii::$app->session->get('login_sms_time');
            Yii::$app->session->remove("login_sms_time");
            Yii::$app->session->removeAll();
            Yii::$app->session->has("login_sms_time");
            Yii::$app->session->getFlash("login_sms_time");
            Yii::$app->session->addFlash("login_sms_time", time() + 360);
            Yii::$app->session->setFlash("login_sms_time", time() + 360);
            print_r(Yii::$app->session);
            print_r($_SESSION);
        }
        // 设置session变量：
        Yii::app()->session['var'] = 'value';
        //使用：
        echo Yii::app()->session['var'];
        //移除：
        unset(Yii::app()->session['var']);

        //移去所有session变量，然后，调用
        Yii::app()->session->clear();
        //移去存储在服务器端的数据。
        Yii::app()->session->destroy();
    }

    //缓存方法总结
    public function yii2cache($param) {
        // 加载缓存组件
        $cache = Yii::$app->cache;

        // 添加一个缓存
        $cache->add('name', 'zhangsan');

        // 更改一个缓存
        $cache->set('name', 'lisi');

        // 删除一个缓存
        $cache->delete('name');

        // 获取缓存内容
        $cache->get('name');

        // 查看缓存是否存在
        if ($cache->exists('name')){
            echo '存在';
        }

        // 同时增加多个缓存
        $cache->madd(['name' => 'zhangsan', 'age' => 18]);

        // 同时获取多个缓存
        var_dump($cache->mget(['name', 'age']));

        // 清空缓存
        $cache->flush();
        
        // 加载组件
        $cache = \Yii::$app->cache;

        // 文件依赖
        $dependency = new \yii\caching\FileDependency(['fileName' => 'robots.txt']);
        // 如果 robots.txt 被修改，该缓存也立刻失效
        $cache->add('the', 'hello world！', 3000, $dependency);
        $result = $cache->get('the');

        // 表达式依赖
        $dependency = new \yii\caching\ExpressionDependency(
                ['expression' => '\Yii::$app->request->get("name")']
        );
        // 这里使用的表达式是获取$_GET['name']的值，如果值改变，该缓存失效
        $cache->add('two', 'hello world！', 3000, $dependency);
        $result = $cache->get('two');

        // 数据库依赖
        $dependency = new \yii\caching\DbDependency(
                ['sql' => 'SELECT count(*) FROM test.user']
        );
        // 当数据库字段发生变化时，该缓存失效
        $cache->add('three', 'hello world！', 3000, $dependency);
        $result = $cache->get('three');
    }

}
||||||| .r155
<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Query;
use yii\imagine\Image;

/**
 * Yii 提供一系列常用的核心验证器，主要存在于 yii\validators 命名空间之下
 */
class CommentModel extends ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        // return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // 检查 "username" 与 "password" 是否为空
            [['username', 'password'], 'required'],
            // 检查 "selected" 是否为 0 或 1，无视数据类型
            ['selected', 'boolean'],
            // 检查 "deleted" 是否为布尔类型，即 true 或 false
            ['deleted', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => true], //strict：是否要求待测输入必须严格匹配 trueValue 或 falseValue。默认为 false。
            //验证码
            ['verificationCode', 'captcha'],
            //['verifyCode', 'captcha','captchaAction'=>'admin/index/captcha','message'=>'验 证码不正确！'], 这种写法在官网自带的LoginForm.php中有写到，大家可以没事看看 ]; 
            // 检查 "password" 特性的值是否与 "password_repeat" 的值相同
            ['password', 'compare'],
            // 检查年龄是否大于等于 30
            ['age', 'compare', 'compareValue' => 30, 'operator' => '>='],
            // 若 "age" 为空，则将其设为 null
            ['age', 'default', 'value' => null],
            // 若 "country" 为空，则将其设为 "USA"
            ['country', 'default', 'value' => 'USA'],
            // 若 "from" 和 "to" 为空，则分别给他们分配自今天起，3 天后和 6 天后的日期。
            [['from', 'to'], 'default', 'value' => function ($model, $attribute) {
                    return date('Y-m-d', strtotime($attribute === 'to' ? '+3 days' : '+6 days '));
                }],
            // 检查 "salary" 是否为浮点数
            ['salary', 'double'],
            // checks if every category ID is an integer
            ['categoryIDs', 'each', 'rule' => ['integer']],
            // 检查 "email" 是否为有效的邮箱地址
            ['email', 'email'],
            // a1 需要在 "a1" 特性所代表的字段内存在
            ['a1', 'exist'],
            // a1 必需存在，但检验的是 a1 的值在字段 a2 中的存在性
            ['a1', 'exist', 'targetAttribute' => 'a2'],
            // a1 和 a2 的值都需要存在，且它们都能收到错误提示
            [['a1', 'a2'], 'exist', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的值都需要存在，只有 a1 能接收到错误信息
            ['a1', 'exist', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a1 的值来确定 a1 的存在性
            ['a1', 'exist', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // a1 必需存在，若 a1 为数组，则其每个子元素都必须存在。
            ['a1', 'exist', 'allowArray' => true],
            // 检查 "primaryImage" 是否为 PNG, JPG 或 GIF 格式的上传图片。
            // 文件大小必须小于  1MB
            ['primaryImage', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024],
            // trim 掉 "username" 和 "email" 输入
            [['username', 'email'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            // 标准化 "phone" 输入
            ['phone', 'filter', 'filter' => function ($value) {
                    // 在此处标准化输入的电话号码
                    return $value;
                }],
            // 检查 "primaryImage" 是否为适当尺寸的有效图片
            ['primaryImage', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 100, 'maxWidth' => 1000,
                'minHeight' => 100, 'maxHeight' => 1000,
            ],
            // 检查 "level" 是否为 1、2 或 3 中的一个
            ['level', 'in', 'range' => [1, 2, 3]],
            // 检查 "age" 是否为整数
            ['age', 'integer'],
            // 检查 "username" 是否由字母开头，且只包含单词字符
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            // 检查 "salary" 是否为数字
            ['salary', 'number'],
            // 标记 "description" 为安全特性
            ['description', 'safe'],
            // 检查 "username" 是否为长度 4 到 24 之间的字符串
            ['username', 'string', 'length' => [4, 24]],
            // a1 需要在 "a1" 特性所代表的字段内唯一
            ['a1', 'unique'],
            // a1 需要唯一，但检验的是 a1 的值在字段 a2 中的唯一性
            ['a1', 'unique', 'targetAttribute' => 'a2'],
            // a1 和 a2 的组合需要唯一，且它们都能收到错误提示
            [['a1', 'a2'], 'unique', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的组合需要唯一，只有 a1 能接收错误提示
            ['a1', 'unique', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a3 的值来确定 a1 的唯一性
            ['a1', 'unique', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // 检查 "website" 是否为有效的 URL。若没有 URI 方案，
            // 则给 "website" 特性加 "http://" 前缀
            ['website', 'url', 'defaultScheme' => 'http'],
            [['pid', 'displayorder'], 'integer', 'on' => ['update', 'register']],
            [['title', 'displayorder', 'type'], 'required', 'on' => ['update', 'register']],
            [['title'], 'string', 'max' => 30, 'unique', 'targetClass' => self::className(), 'message' => '此目录名已经被使用', 'on' => ['update', 'register']],
            [['type'], 'string', 'max' => 15, 'on' => 'register'],
        ];
    }

    //下载文件
    public function actionDownload() {
        return \Yii::$app->response->setDownloadHeaders("http://xxx.com/apk/com.trade.activity.3.0.8.apk");
        //return \Yii::$app->response->sendFile("./com.trade.activity.3.0.8.apk");
    }

    //关联关系查询
    public function getOrders() {
        //客户和订单是一对多的关系所以用hasMany
        //此处OrdersModel在CustomerModel顶部别忘了加对应的命名空间
        //id对应的是OrdersModel的id字段，order_id对应CustomerModel的order_id字段
        return $this->hasMany(OrdersModel::className(), ['id' => 'order_id']);
    }

    public function getCountry() {
        //客户和国家是一对一的关系所以用hasOne
        return $this->hasOne(CountrysModel::className(), ['id' => 'Country_id']);
    }

    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['register'] = ['pid', 'title', 'type'];
        $scenarios['update'] = ['pid', 'title', '

            '];
        return $scenarios;
    }

    //图片水印处理
    function imageshandel() {
        //图片路径请根据自己的项目的位置调整

        Image::frame(Yii::getAlias('@backend') . '/web/uploads/gw-bg.jpg', 5, '666', 0)
                ->rotate(-8)
                ->save(Yii::getAlias('@backend') . '/web/uploads/image.jpg', ['quality' => 50]);
        //生成一个缩略图
        Image::thumbnail(Yii::getAlias('@backend') . '/web/uploads/image.jpg', 200, 200)
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/imagethumb-test-image.jpg'), ['quality' => 80]);


        //裁剪一张图片并存储
        Image::crop(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/image.jpg'), 300, 300, [300, 300])
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/crop-photo.jpg'), ['quality' => 80]);


        // 给一张图片加水印
        Image::watermark(Yii::getAlias('@backend/web/uploads/image.jpg'), Yii::getAlias('@backend/web/uploads/crop-photo.jpg'), [100, 100])
                ->save(Yii::getAlias('@backend/web/uploads/watermark-photo.jpg'), ['quality' => 100]);


        //给图片加文字
        $textOpt = ['color' => '000', 'size' => '32', 'angle' => 0];
        $fontFile = Yii::getAlias('@backend/web/uploads/叶根友刀锋黑草.ttf');
        Image::text(Yii::getAlias('@backend/web/uploads/image.jpg'), '这是一张图片的水印', $fontFile, [800, 850], $textOpt)
                ->save(Yii::getAlias('@backend/web/uploads/text-photo.jpg'), ['quality' => 100]);
    }

    //生成url
    function generateurl() {
        \yii\helpers\Url::toRoute('mysql/view/' . $model->id);
        Yii::$app->urlManager->createUrl(['mysql/chart/', 'server_id' => $model->server_id, 'time_interval' => '1800', 'end' => '0']);
    }

    //条件筛选语句
    function yiiandwhere() {
        //Yii2 获取接口传过来的 JSON 数据
        Yii::$app->request->rawBody;
        // post
        Yii::$app->request->bodyParams;
        // get
        $server_id = Yii::$app->getRequest()->get()['server_id'];
        Yii::$app->request->queryParams;
        $query = new Query;
        $query->select('ID, City,State,StudentName')
                ->from('student')
                ->where(['IsActive' => 1])
                ->andWhere(['not', ['City' => null]])
                ->andWhere(['not', ['State' => null]])
                ->orderBy(['rand()' => SORT_DESC])
                ->limit(10);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->andWhere(['pid' => 0]);
        User::find()->where(['and', ['xxx' => 0, 'yyy' => 2], ['>', 'zzz', $time]]);
        $dataProvider->query->andWhere(['>', 'pid', 0]);
    }

    //事务用法
    function yiitransaction() {
        $connection = new Connection();
        // INSERT
        $connection->createCommand()->insert('user', [
            'name' => 'Sam',
            'age' => 30,
        ])->execute();

        // INSERT 一次插入多行
        $connection->createCommand()->batchInsert('user', ['name', 'age'], [
            ['Tom', 30],
            ['Jane', 20],
            ['Linda', 25],
        ])->execute();

        // UPDATE
        $connection->createCommand()->update('user', ['status' => 1], 'age > 30')->execute();

        // DELETE
        $connection->createCommand()->delete('user', 'status = 0')->execute();


        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            //.... other SQL executions
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        //创建表
        // 创建表
        $connection->createCommand()->createTable('post', [
            'id' => 'pk',
            'title' => 'string',
            'text' => 'text',
        ]);

        //预处理
        $command = $connection->createCommand('SELECT * FROM post WHERE id=:id');
        $command->bindValue(':id', $_GET['id']);
        $post = $command->query();
    }

    //生成表语句
    function generatetabel() {

        echo dirname(Yii::$app->basePath);

        //        $mir = new Migration();
        //        $sch = new \yii\db\mysql\Schema;
        //        $mir->createTable('post', [
        //            'id' => 'pk',
        //            'title' => $sch::TYPE_STRING . ' NOT NULL',
        //            'text' => $sch::TYPE_TEXT,
        //        ]);
        //相当于下面try{}catch{}语句     
        Yii::$app->db->transaction(function() {
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
        });
        // 在主服务器连接上开始事务
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();


        try {
            // 所有的查询都在主服务器上执行
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
            $db->createCommand("UPDATE post SET title='demo' WHERE id=1")->execute();
//            $model = new MerchantInfo();
//            if (!$model->save()) {
//                $error = array_values($model->getFirstErrors())[0];
//                throw new Exception($error); //抛出异常
//            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'name',
                'value' => 'Larry',
                'expire' => time() + 3600
            ]));
            throw $e;
        }
    }

    //发送邮件
    function sendEmail() {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
        $mail->setSubject("邮件主题"); //邮件主题 
        $mail->setTextBody('测试text'); //发布纯文字文本 
        $mail->setHtmlBody("测试html text"); //发送的消息内容 
        var_dump($mail->send());
        exit;
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
        //{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

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

    //session相关操作
    public function aboutSession() {

        //检查session是否打开
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        } else {
            echo "有session";
            Yii::$app->session->set('login_sms_time', time());
            Yii::$app->session->get('login_sms_time');
            Yii::$app->session->remove("login_sms_time");
            Yii::$app->session->removeAll();
            Yii::$app->session->has("login_sms_time");
            Yii::$app->session->getFlash("login_sms_time");
            Yii::$app->session->addFlash("login_sms_time", time() + 360);
            Yii::$app->session->setFlash("login_sms_time", time() + 360);
            print_r(Yii::$app->session);
            print_r($_SESSION);
        }
        // 设置session变量：
        Yii::app()->session['var'] = 'value';
        //使用：
        echo Yii::app()->session['var'];
        //移除：
        unset(Yii::app()->session['var']);

        //移去所有session变量，然后，调用
        Yii::app()->session->clear();
        //移去存储在服务器端的数据。
        Yii::app()->session->destroy();
    }

    //缓存方法总结
    public function yii2cache($param) {
        // 加载缓存组件
        $cache = Yii::$app->cache;

        // 添加一个缓存
        $cache->add('name', 'zhangsan');

        // 更改一个缓存
        $cache->set('name', 'lisi');

        // 删除一个缓存
        $cache->delete('name');

        // 获取缓存内容
        $cache->get('name');

        // 查看缓存是否存在
        if ($cache->exists('name')){
            echo '存在';
        }

        // 同时增加多个缓存
        $cache->madd(['name' => 'zhangsan', 'age' => 18]);

        // 同时获取多个缓存
        var_dump($cache->mget(['name', 'age']));

        // 清空缓存
        $cache->flush();
        
        // 加载组件
        $cache = \Yii::$app->cache;

        // 文件依赖
        $dependency = new \yii\caching\FileDependency(['fileName' => 'robots.txt']);
        // 如果 robots.txt 被修改，该缓存也立刻失效
        $cache->add('the', 'hello world！', 3000, $dependency);
        $result = $cache->get('the');

        // 表达式依赖
        $dependency = new \yii\caching\ExpressionDependency(
                ['expression' => '\Yii::$app->request->get("name")']
        );
        // 这里使用的表达式是获取$_GET['name']的值，如果值改变，该缓存失效
        $cache->add('two', 'hello world！', 3000, $dependency);
        $result = $cache->get('two');

        // 数据库依赖
        $dependency = new \yii\caching\DbDependency(
                ['sql' => 'SELECT count(*) FROM test.user']
        );
        // 当数据库字段发生变化时，该缓存失效
        $cache->add('three', 'hello world！', 3000, $dependency);
        $result = $cache->get('three');
    }

}
=======
<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Query;
use yii\imagine\Image;

/**
 * Yii 提供一系列常用的核心验证器，主要存在于 yii\validators 命名空间之下
 */
class CommentModel extends ActiveRecord {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        // return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // 检查 "username" 与 "password" 是否为空
            [['username', 'password'], 'required'],
            // 检查 "selected" 是否为 0 或 1，无视数据类型
            ['selected', 'boolean'],
            // 检查 "deleted" 是否为布尔类型，即 true 或 false
            ['deleted', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => true], //strict：是否要求待测输入必须严格匹配 trueValue 或 falseValue。默认为 false。
            //验证码
            ['verificationCode', 'captcha'],
            //['verifyCode', 'captcha','captchaAction'=>'admin/index/captcha','message'=>'验 证码不正确！'], 这种写法在官网自带的LoginForm.php中有写到，大家可以没事看看 ]; 
            // 检查 "password" 特性的值是否与 "password_repeat" 的值相同
            ['password', 'compare'],
            // 检查年龄是否大于等于 30
            ['age', 'compare', 'compareValue' => 30, 'operator' => '>='],
            // 若 "age" 为空，则将其设为 null
            ['age', 'default', 'value' => null],
            // 若 "country" 为空，则将其设为 "USA"
            ['country', 'default', 'value' => 'USA'],
            // 若 "from" 和 "to" 为空，则分别给他们分配自今天起，3 天后和 6 天后的日期。
            [['from', 'to'], 'default', 'value' => function ($model, $attribute) {
                    return date('Y-m-d', strtotime($attribute === 'to' ? '+3 days' : '+6 days '));
                }],
            // 检查 "salary" 是否为浮点数
            ['salary', 'double'],
            // checks if every category ID is an integer
            ['categoryIDs', 'each', 'rule' => ['integer']],
            // 检查 "email" 是否为有效的邮箱地址
            ['email', 'email'],
            // a1 需要在 "a1" 特性所代表的字段内存在
            ['a1', 'exist'],
            // a1 必需存在，但检验的是 a1 的值在字段 a2 中的存在性
            ['a1', 'exist', 'targetAttribute' => 'a2'],
            // a1 和 a2 的值都需要存在，且它们都能收到错误提示
            [['a1', 'a2'], 'exist', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的值都需要存在，只有 a1 能接收到错误信息
            ['a1', 'exist', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a1 的值来确定 a1 的存在性
            ['a1', 'exist', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // a1 必需存在，若 a1 为数组，则其每个子元素都必须存在。
            ['a1', 'exist', 'allowArray' => true],
            // 检查 "primaryImage" 是否为 PNG, JPG 或 GIF 格式的上传图片。
            // 文件大小必须小于  1MB
            ['primaryImage', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024],
            // trim 掉 "username" 和 "email" 输入
            [['username', 'email'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            // 标准化 "phone" 输入
            ['phone', 'filter', 'filter' => function ($value) {
                    // 在此处标准化输入的电话号码
                    return $value;
                }],
            // 检查 "primaryImage" 是否为适当尺寸的有效图片
            ['primaryImage', 'image', 'extensions' => 'png, jpg',
                'minWidth' => 100, 'maxWidth' => 1000,
                'minHeight' => 100, 'maxHeight' => 1000,
            ],
            // 检查 "level" 是否为 1、2 或 3 中的一个
            ['level', 'in', 'range' => [1, 2, 3]],
            // 检查 "age" 是否为整数
            ['age', 'integer'],
            // 检查 "username" 是否由字母开头，且只包含单词字符
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            // 检查 "salary" 是否为数字
            ['salary', 'number'],
            // 标记 "description" 为安全特性
            ['description', 'safe'],
            // 检查 "username" 是否为长度 4 到 24 之间的字符串
            ['username', 'string', 'length' => [4, 24]],
            // a1 需要在 "a1" 特性所代表的字段内唯一
            ['a1', 'unique'],
            // a1 需要唯一，但检验的是 a1 的值在字段 a2 中的唯一性
            ['a1', 'unique', 'targetAttribute' => 'a2'],
            // a1 和 a2 的组合需要唯一，且它们都能收到错误提示
            [['a1', 'a2'], 'unique', 'targetAttribute' => ['a1', 'a2']],
            // a1 和 a2 的组合需要唯一，只有 a1 能接收错误提示
            ['a1', 'unique', 'targetAttribute' => ['a1', 'a2']],
            // 通过同时在 a2 和 a3 字段中检查 a2 和 a3 的值来确定 a1 的唯一性
            ['a1', 'unique', 'targetAttribute' => ['a2', 'a1' => 'a3']],
            // 检查 "website" 是否为有效的 URL。若没有 URI 方案，
            // 则给 "website" 特性加 "http://" 前缀
            ['website', 'url', 'defaultScheme' => 'http'],
            [['pid', 'displayorder'], 'integer', 'on' => ['update', 'register']],
            [['title', 'displayorder', 'type'], 'required', 'on' => ['update', 'register']],
            [['title'], 'string', 'max' => 30, 'unique', 'targetClass' => self::className(), 'message' => '此目录名已经被使用', 'on' => ['update', 'register']],
            [['type'], 'string', 'max' => 15, 'on' => 'register'],
        ];
    }

    //下载文件
    public function actionDownload() {
        return \Yii::$app->response->setDownloadHeaders("http://xxx.com/apk/com.trade.activity.3.0.8.apk");
        //return \Yii::$app->response->sendFile("./com.trade.activity.3.0.8.apk");
    }

    //关联关系查询
    public function getOrders() {
        //客户和订单是一对多的关系所以用hasMany
        //此处OrdersModel在CustomerModel顶部别忘了加对应的命名空间
        //id对应的是OrdersModel的id字段，order_id对应CustomerModel的order_id字段
        return $this->hasMany(OrdersModel::className(), ['id' => 'order_id']);
    }

    public function getCountry() {
        //客户和国家是一对一的关系所以用hasOne
        return $this->hasOne(CountrysModel::className(), ['id' => 'Country_id']);
    }

    //场景设置
    public function scenarios() {
        $scenarios = parent::scenarios();

        //各个场景的活动属性  
        $scenarios['register'] = ['pid', 'title', 'type'];
        $scenarios['update'] = ['pid', 'title', '

            '];
        return $scenarios;
    }

    //数据库操作
    function oprtatorTable() {
        User::find()->all();
        //此方法返回所有数据；

        User::findOne($id);
        //此方法返回 主键 id = 1 的一条数据(举个例子)；

        User::find()->where(['name' => '小伙儿'])->one();
        //此方法返回 ['name' => '小伙儿'] 的一条数据；

        User::find()->where(['name' => '小伙儿'])->all();
        //此方法返回 ['name' => '小伙儿'] 的所有数据；

        User::find()->orderBy('id DESC')->all();
        //此方法是排序查询；

        User::findBySql('SELECT * FROM user')->all();
        //此方法是用 sql 语句查询 user 表里面的所有数据；

        User::findBySql('SELECT * FROM user')->one();
        ///此方法是用 sql 语句查询 user 表里面的一条数据；

        User::find()->andWhere(['sex' => '男', 'age' => '24'])->count('id');
        //统计符合条件的总条数；

        User::find()->andFilterWhere(['like', 'name', '小伙儿']);
        //此方法是用 like 查询 name 等于 小伙儿的 数据

        User::find()->one();
        //此方法返回一条数据；

        User::find()->all();
        //此方法返回所有数据；

        User::find()->count();
        //此方法返回记录的数量；

        User::find()->average();
        //此方法返回指定列的平均值；

        User::find()->min();
        //此方法返回指定列的最小值 ；

        User::find()->max();
        //此方法返回指定列的最大值 ；

        User::find()->scalar();
        //此方法返回值的第一行第一列的查询结果；

        User::find()->column();
        //此方法返回查询结果中的第一列的值；

        User::find()->exists();
        //此方法返回一个值指示是否包含查询结果的数据行；

        User::find()->batch(10);
        //每次取 10 条数据

        User::find()->each(10);
        //每次取 10 条数据， 迭代查询
    }

    //图片水印处理
    function imageshandel() {
        //图片路径请根据自己的项目的位置调整

        Image::frame(Yii::getAlias('@backend') . '/web/uploads/gw-bg.jpg', 5, '666', 0)
                ->rotate(-8)
                ->save(Yii::getAlias('@backend') . '/web/uploads/image.jpg', ['quality' => 50]);
        //生成一个缩略图
        Image::thumbnail(Yii::getAlias('@backend') . '/web/uploads/image.jpg', 200, 200)
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/imagethumb-test-image.jpg'), ['quality' => 80]);


        //裁剪一张图片并存储
        Image::crop(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/image.jpg'), 300, 300, [300, 300])
                ->save(Yii::getAlias(Yii::getAlias('@backend') . '/web/uploads/crop-photo.jpg'), ['quality' => 80]);


        // 给一张图片加水印
        Image::watermark(Yii::getAlias('@backend/web/uploads/image.jpg'), Yii::getAlias('@backend/web/uploads/crop-photo.jpg'), [100, 100])
                ->save(Yii::getAlias('@backend/web/uploads/watermark-photo.jpg'), ['quality' => 100]);


        //给图片加文字
        $textOpt = ['color' => '000', 'size' => '32', 'angle' => 0];
        $fontFile = Yii::getAlias('@backend/web/uploads/叶根友刀锋黑草.ttf');
        Image::text(Yii::getAlias('@backend/web/uploads/image.jpg'), '这是一张图片的水印', $fontFile, [800, 850], $textOpt)
                ->save(Yii::getAlias('@backend/web/uploads/text-photo.jpg'), ['quality' => 100]);
    }

    //生成url
    function generateurl() {
        \yii\helpers\Url::toRoute('mysql/view/' . $model->id);
        Yii::$app->urlManager->createUrl(['mysql/chart/', 'server_id' => $model->server_id, 'time_interval' => '1800', 'end' => '0']);
    }

    //条件筛选语句
    function yiiandwhere() {
        //Yii2 获取接口传过来的 JSON 数据
        Yii::$app->request->rawBody;
        // post
        Yii::$app->request->bodyParams;
        // get
        $server_id = Yii::$app->getRequest()->get()['server_id'];
        Yii::$app->request->queryParams;
        $query = new Query;
        $query->select('ID, City,State,StudentName')
                ->from('student')
                ->where(['IsActive' => 1])
                ->andWhere(['not', ['City' => null]])
                ->andWhere(['not', ['State' => null]])
                ->orderBy(['rand()' => SORT_DESC])
                ->limit(10);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->andWhere(['pid' => 0]);
        User::find()->where(['and', ['xxx' => 0, 'yyy' => 2], ['>', 'zzz', $time]]);
        $dataProvider->query->andWhere(['>', 'pid', 0]);
    }

    //事务用法
    function yiitransaction() {
        $connection = new Connection();
        // INSERT
        $connection->createCommand()->insert('user', [
            'name' => 'Sam',
            'age' => 30,
        ])->execute();

        // INSERT 一次插入多行
        $connection->createCommand()->batchInsert('user', ['name', 'age'], [
            ['Tom', 30],
            ['Jane', 20],
            ['Linda', 25],
        ])->execute();

        // UPDATE
        $connection->createCommand()->update('user', ['status' => 1], 'age > 30')->execute();

        // DELETE
        $connection->createCommand()->delete('user', 'status = 0')->execute();


        $transaction = $connection->beginTransaction();
        try {
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            //.... other SQL executions
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        //创建表
        // 创建表
        $connection->createCommand()->createTable('post', [
            'id' => 'pk',
            'title' => 'string',
            'text' => 'text',
        ]);

        //预处理
        $command = $connection->createCommand('SELECT * FROM post WHERE id=:id');
        $command->bindValue(':id', $_GET['id']);
        $post = $command->query();
    }

    //生成表语句
    function generatetabel() {

        echo dirname(Yii::$app->basePath);

        //        $mir = new Migration();
        //        $sch = new \yii\db\mysql\Schema;
        //        $mir->createTable('post', [
        //            'id' => 'pk',
        //            'title' => $sch::TYPE_STRING . ' NOT NULL',
        //            'text' => $sch::TYPE_TEXT,
        //        ]);
        //相当于下面try{}catch{}语句     
        Yii::$app->db->transaction(function() {
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
        });
        // 在主服务器连接上开始事务
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();


        try {
            // 所有的查询都在主服务器上执行
            $rows = $db->createCommand('SELECT * FROM post LIMIT 10')->queryAll();
            $db->createCommand("UPDATE post SET title='demo' WHERE id=1")->execute();
//            $model = new MerchantInfo();
//            if (!$model->save()) {
//                $error = array_values($model->getFirstErrors())[0];
//                throw new Exception($error); //抛出异常
//            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'name',
                'value' => 'Larry',
                'expire' => time() + 3600
            ]));
            throw $e;
        }
    }

    //发送邮件
    function sendEmail() {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('2562611287@qq.com'); //要发送给那个人的邮箱 
        $mail->setSubject("邮件主题"); //邮件主题 
        $mail->setTextBody('测试text'); //发布纯文字文本 
        $mail->setHtmlBody("测试html text"); //发送的消息内容 
        var_dump($mail->send());
        exit;
    }

    /**
     * 短信接口
     */
    public function smsSend() {
        include "TopSdk.php";
        date_default_timezone_set('Asia/Shanghai');
        //{"alibaba_aliqin_fc_sms_num_send_response":{"result":{"err_code":"0","model":"108429488956^1111390172662","success":true},"request_id":"43x5sw6gd816"}}
        $c = new TopClient;
        $c->appkey = '24445262';
        $c->secretKey = 'c4d253919f59ce113a4e235a41c52e9f';
        // $req = new TradeVoucherUploadRequest;
        // $req->setFileName("example");
        // $req->setFileData("@/Users/xt/Downloads/1.jpg");
        // $req->setSellerNick("奥利奥官方旗舰店");
        // $req->setBuyerNick("101NufynDYcbjf2cFQDd62j8M/mjtyz6RoxQ2OL1c0e/Bc=");
        // var_dump($c->execute($req));

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

    //session相关操作
    public function aboutSession() {

        //检查session是否打开
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        } else {
            echo "有session";
            Yii::$app->session->set('login_sms_time', time());
            Yii::$app->session->get('login_sms_time');
            Yii::$app->session->remove("login_sms_time");
            Yii::$app->session->removeAll();
            Yii::$app->session->has("login_sms_time");
            Yii::$app->session->getFlash("login_sms_time");
            Yii::$app->session->addFlash("login_sms_time", time() + 360);
            Yii::$app->session->setFlash("login_sms_time", time() + 360);
            print_r(Yii::$app->session);
            print_r($_SESSION);
        }
        // 设置session变量：
        Yii::app()->session['var'] = 'value';
        //使用：
        echo Yii::app()->session['var'];
        //移除：
        unset(Yii::app()->session['var']);

        //移去所有session变量，然后，调用
        Yii::app()->session->clear();
        //移去存储在服务器端的数据。
        Yii::app()->session->destroy();
    }

    //缓存方法总结
    public function yii2cache($param) {
        // 加载缓存组件
        $cache = Yii::$app->cache;

        // 添加一个缓存
        $cache->add('name', 'zhangsan');

        // 更改一个缓存
        $cache->set('name', 'lisi');

        // 删除一个缓存
        $cache->delete('name');

        // 获取缓存内容
        $cache->get('name');

        // 查看缓存是否存在
        if ($cache->exists('name')) {
            echo '存在';
        }

        // 同时增加多个缓存
        $cache->madd(['name' => 'zhangsan', 'age' => 18]);

        // 同时获取多个缓存
        var_dump($cache->mget(['name', 'age']));

        // 清空缓存
        $cache->flush();

        // 加载组件
        $cache = \Yii::$app->cache;

        // 文件依赖
        $dependency = new \yii\caching\FileDependency(['fileName' => 'robots.txt']);
        // 如果 robots.txt 被修改，该缓存也立刻失效
        $cache->add('the', 'hello world！', 3000, $dependency);
        $result = $cache->get('the');

        // 表达式依赖
        $dependency = new \yii\caching\ExpressionDependency(
                ['expression' => '\Yii::$app->request->get("name")']
        );
        // 这里使用的表达式是获取$_GET['name']的值，如果值改变，该缓存失效
        $cache->add('two', 'hello world！', 3000, $dependency);
        $result = $cache->get('two');

        // 数据库依赖
        $dependency = new \yii\caching\DbDependency(
                ['sql' => 'SELECT count(*) FROM test.user']
        );
        // 当数据库字段发生变化时，该缓存失效
        $cache->add('three', 'hello world！', 3000, $dependency);
        $result = $cache->get('three');
    }

}
>>>>>>> .r156
