<<<<<<< .mine
<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Region;

/**
 * RegionService represents the model behind the search form about `common\models\Region`.
 */
class RegionService extends Region {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'parentCode', 'type'], 'integer'],
            [['name', 'fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Region::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
            'parentCode' => $this->parentCode,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'fullName', $this->fullName]);

        return $dataProvider;
    }

    /**
     * 根据父id获取子集区域
     */
    function getchilds($pid) {
        $condition["parentCode"] = $pid;
        $childsList = $this::find()->where($condition)->asArray()->all();
        return $childsList;
    }

    /*
     * 查询构造地区树
     */

    function getRegionTree() {

        $regionTree = [];

        $regionAll = Region::find()->asArray()->all();
        foreach ($regionAll as $key => $value) {
            switch ($value["type"]) {
                case 0:
                    $regionTree["country"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 1:
                    $regionTreeTemp["province"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 2:
                    $regionTreeTemp["city"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 3:
                    $regionTreeTemp["area"][] = $value;
                    unset($regionAll[$key]);
                    break;
                default:
                    break;
            }
        }
        $regionTree["country"]["child"] = $regionTreeTemp["province"];
        foreach ($regionTree["country"]["child"] as $key => $value) {

            foreach ($regionTreeTemp["city"] as $key1 => $value1) {
                $ii = 0;
                $jj = 0;
                if ($value1["parentCode"] == $value["code"]) {
                    $regionTree["country"]["child"][$key]["child"][$ii] = $value1;
                    foreach ($regionTreeTemp["area"] as $key3 => $value3) {
                        if ($value3["parentCode"] == $value1["code"]) {
                            $regionTree["country"]["child"][$key]["child"][$ii]["child"][$jj] = $value3;
                            $jj++;
                            unset($regionTreeTemp["area"][$key3]);
                        } else {
                            
                        }
                    }
                    $ii++;
                    unset($regionTreeTemp["city"][$key1]);
                }
            }
            unset($regionTreeTemp["city"][$key]);
        }
        return $regionTree;
    }

    /**
     * 递归，查找子孙树
     */
    function subtree($arr, $id = 0, $lev = 1) {
        $subs = array(); // 子孙数组
        foreach ($arr as $v) {
            if ($v['parent'] == $id) {
                $v['lev'] = $lev;
                $subs[] = $v; // 举例说找到array('id'=>1,'name'=>'安徽','parent'=>0),
                $subs = array_merge($subs, subtree($arr, $v['id'], $lev + 1));
            }
        }
        return $subs;
        //$tree = subtree($area,0,1);
//string str_repeat ( string $input , int $multiplier )
//返回 input 重复 multiplier 次后的结果。
//foreach($tree as $v) {
//    echo str_repeat(' |- ',$v['lev']),$v['name'],'<br />';  //str_repeat — 重复一个字符串
//}
    }

    /**
     * 迭代，求家谱树
     */
    function tree($arr, $id) {
        $tree = array();
        while ($id !== 0) {
            foreach ($arr as $v) {
                if ($v['id'] == $id) {
                    $tree[] = $v;
                    $id = $v['parent'];
                    break;
                }
            }
        }
        return $tree;
    }

}
||||||| .r155
<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Region;

/**
 * RegionService represents the model behind the search form about `common\models\Region`.
 */
class RegionService extends Region {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'parentCode', 'type'], 'integer'],
            [['name', 'fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Region::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
            'parentCode' => $this->parentCode,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'fullName', $this->fullName]);

        return $dataProvider;
    }

    /**
     * 根据父id获取子集区域
     */
    function getchilds($pid) {
        $condition["parentCode"] = $pid;
        $childsList = $this::find()->where($condition)->asArray()->all();
        return $childsList;
    }

    /*
     * 查询构造地区树
     */

    function getRegionTree() {

        $regionTree = [];

        $regionAll = Region::find()->asArray()->all();
        foreach ($regionAll as $key => $value) {
            switch ($value["type"]) {
                case 0:
                    $regionTree["country"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 1:
                    $regionTreeTemp["province"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 2:
                    $regionTreeTemp["city"][] = $value;
                    unset($regionAll[$key]);
                    break;
                case 3:
                    $regionTreeTemp["area"][] = $value;
                    unset($regionAll[$key]);
                    break;
                default:
                    break;
            }
        }
        $regionTree["country"]["child"] = $regionTreeTemp["province"];
        foreach ($regionTree["country"]["child"] as $key => $value) {

            foreach ($regionTreeTemp["city"] as $key1 => $value1) {
                $ii = 0;
                $jj = 0;
                if ($value1["parentCode"] == $value["code"]) {
                    $regionTree["country"]["child"][$key]["child"][$ii] = $value1;
                    foreach ($regionTreeTemp["area"] as $key3 => $value3) {
                        if ($value3["parentCode"] == $value1["code"]) {
                            $regionTree["country"]["child"][$key]["child"][$ii]["child"][$jj] = $value3;
                            $jj++;
                            unset($regionTreeTemp["area"][$key3]);
                        } else {
                            
                        }
                    }
                    $ii++;
                    unset($regionTreeTemp["city"][$key1]);
                }
            }
            unset($regionTreeTemp["city"][$key]);
        }
        return $regionTree;
    }

    /**
     * 递归，查找子孙树
     */
    function subtree($arr, $id = 0, $lev = 1) {
        $subs = array(); // 子孙数组
        foreach ($arr as $v) {
            if ($v['parent'] == $id) {
                $v['lev'] = $lev;
                $subs[] = $v; // 举例说找到array('id'=>1,'name'=>'安徽','parent'=>0),
                $subs = array_merge($subs, subtree($arr, $v['id'], $lev + 1));
            }
        }
        return $subs;
        //$tree = subtree($area,0,1);
//string str_repeat ( string $input , int $multiplier )
//返回 input 重复 multiplier 次后的结果。
//foreach($tree as $v) {
//    echo str_repeat(' |- ',$v['lev']),$v['name'],'<br />';  //str_repeat — 重复一个字符串
//}
    }

    /**
     * 迭代，求家谱树
     */
    function tree($arr, $id) {
        $tree = array();
        while ($id !== 0) {
            foreach ($arr as $v) {
                if ($v['id'] == $id) {
                    $tree[] = $v;
                    $id = $v['parent'];
                    break;
                }
            }
        }
        return $tree;
    }

}
=======
<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Region;

/**
 * RegionService represents the model behind the search form about `common\models\Region`.
 */
class RegionService extends Region {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'parentCode', 'type'], 'integer'],
            [['name', 'fullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Region::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'code' => $this->code,
            'parentCode' => $this->parentCode,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'fullName', $this->fullName]);

        return $dataProvider;
    }

    /**
     * 根据父id获取子集区域
     */
    function getchilds($pid) {
        $condition["parentCode"] = $pid;
        $childsList = $this::find()->where($condition)->asArray()->all();
        return $childsList;
    }

    /*
     * 查询构造地区树
     */

    function getRegionTree() {

        $regionTree = [];
        $cache = Yii::$app->cache;
        if (!$cache->exists('regionTree')) {
            $regionAll = Region::find()->asArray()->all();
            foreach ($regionAll as $key => $value) {
                switch ($value["type"]) {
                    case 0:
                        $regionTree["country"][] = $value;
                        unset($regionAll[$key]);
                        break;
                    case 1:
                        $regionTreeTemp["province"][] = $value;
                        unset($regionAll[$key]);
                        break;
                    case 2:
                        $regionTreeTemp["city"][] = $value;
                        unset($regionAll[$key]);
                        break;
                    case 3:
                        $regionTreeTemp["area"][] = $value;
                        unset($regionAll[$key]);
                        break;
                    default:
                        break;
                }
            }
            $regionTree["country"]["child"] = $regionTreeTemp["province"];
            foreach ($regionTree["country"]["child"] as $key => $value) {

                foreach ($regionTreeTemp["city"] as $key1 => $value1) {
                    $ii = 0;
                    $jj = 0;
                    if ($value1["parentCode"] == $value["code"]) {
                        $regionTree["country"]["child"][$key]["child"][$ii] = $value1;
                        foreach ($regionTreeTemp["area"] as $key3 => $value3) {
                            if ($value3["parentCode"] == $value1["code"]) {
                                $regionTree["country"]["child"][$key]["child"][$ii]["child"][$jj] = $value3;
                                $jj++;
                                unset($regionTreeTemp["area"][$key3]);
                            } else {
                                
                            }
                        }
                        $ii++;
                        unset($regionTreeTemp["city"][$key1]);
                    }
                }
                unset($regionTreeTemp["city"][$key]);
            }
            // 清空缓存
            // $cache->flush();
            // 数据库依赖
            // $dependency = new \yii\caching\DbDependency(
            //          ['sql' => 'SELECT count(*) FROM yii2webdb.hhqy_region']
            //  );
            // $cache->set('regionTree', $regionTree, 0, $dependency);
            //  print_r($regionTree);
            // exit;
            $cache->set('regionTree', $regionTree);
        } else {
            $regionTree = $cache->get('regionTree');
        }




        return $regionTree;
    }

    /**
     * 递归，查找子孙树
     */
    function subtree($arr, $id = 0, $lev = 1) {
        $subs = array(); // 子孙数组
        foreach ($arr as $v) {
            if ($v['parentCode'] == $id) {
                $v['lev'] = $lev;
                $subs[] = $v; // 举例说找到array('id'=>1,'name'=>'安徽','parent'=>0),
                $subs = array_merge($subs, $this->subtree($arr, $v['code'], $lev + 1));
            }
        }
        return $subs;
        //$tree = subtree($area,0,1);
//string str_repeat ( string $input , int $multiplier )
//返回 input 重复 multiplier 次后的结果。
//foreach($tree as $v) {
//    echo str_repeat(' |- ',$v['lev']),$v['name'],'<br />';  //str_repeat — 重复一个字符串
//}
    }

    /**
     * 迭代，求家谱树
     */
    function tree($arr, $id) {
        $tree = array();
        while ($id !== 0) {
            foreach ($arr as $v) {
                if ($v['code'] == $id) {
                    $tree[] = $v;
                    $id = $v['parentCode'];
                    break;
                }
            }
        }
        return $tree;
    }

    /**
     * 查询上级
     */
    function getParents($id) {
        $subid = [];
        while ($id != 0) {
            $pidarray = Region::find()->where(['code' => $id])->asArray()->one();
            $subid[] = $pidarray["code"];
            $id = $pidarray["parentCode"];
        }
        return $subid;
    }

}
>>>>>>> .r156
