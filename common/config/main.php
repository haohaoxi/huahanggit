<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	    "authManager" => [
            "class" => 'yii\rbac\DbManager',
            "defaultRoles" => ["guest"],
			//'itemTable' => 'dbname2.auth_item',
			//'itemChildTable' => 'dbname2.auth_item_child',
			//'assignmentTable' => 'dbname2.auth_assignment',
			//'ruleTable' => 'dbname2.auth_rule',
			
			//yii\rbac\DbManager::$itemTable： 该表存放授权条目（译者注：即角色和权限）。默认表名为 “auth_item” 。
			//yii\rbac\DbManager::$itemChildTable： 该表存放授权条目的层次关系。默认表名为 “auth_item_child”。
			//yii\rbac\DbManager::$assignmentTable： 该表存放授权条目对用户的指派情况。默认表名为 “auth_assignment”。
			//yii\rbac\DbManager::$ruleTable： 该表存放规则。默认表名为 “auth_rule”。

        ],
      //  'cache' => [
           // 'class' => 'yii\caching\FileCache',//文件缓存
			// 'class' => 'yii\redis\Cache',//开启redis缓存
      //  ],
	     'cache' => [
            'class' => 'yii\caching\MemCache',
		//	//单个不轮询就可以不写
         //   'servers' => [
         //       [
         //           'host' => 'localhost',
        //            'port' => 11211,
              //      'weight' => 100,
       //         ],
              //  [
              //      'host' => 'localhost',
               //     'port' => 11211,
               //     'weight' => 50,
               // ],
          // ],
           'useMemcached' => true ,
		//	'serializer' => false,
		//	'options' => [
          //      \Memcached::OPT_COMPRESSION => false,
         //      ],
        ],
		
//Redis
//'redis' => [
//    'class' => 'yii\redis\Connection',
//    'hostname' => '127.0.0.1',
//    'port' => 6379,
//    'database' => 0,//默认有16个库0-15，如果是集群的话，只有一个0。
//],
    ],
];
