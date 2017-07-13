<?php

namespace common\models\service;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleCategory;

/**
 * ArticleCategoryService represents the model behind the search form about `common\models\ArticleCategory`.
 */
class ArticleCategoryService extends ArticleCategory {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'pid', 'displayorder'], 'integer'],
            [['title', 'type'], 'safe'],
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
        $query = ArticleCategory::find();

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
            'id' => $this->id,
            'pid' => $this->pid,
            'displayorder' => $this->displayorder,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }

    /**
     * 获取所有的分类
     */
    public function getCategories($pid, $type = 1) {
        $conddata["type"] = $type;
        is_null($pid) ? "" : $conddata["pid"] = $pid;
        $data = self::find()->where($conddata)->select(['id', 'pid', 'title'])->asArray()->all();
        return $data;
    }

    /**
     * 遍历出各个子类 获得树状结构的数组
     */
    public function getTree($data, $pid = 0, $lev = 1) {
        $tree = [];
        foreach ($data as $value) {
            if ($value['pid'] == $pid) {
                $value['title'] = str_repeat('|__', $lev) . $value['title'];
                $tree[] = $value;
                $tree = array_merge($tree, self::getTree($data, $value['id'], $lev + 1));
            }
        }
        return $tree;
    }

    /**
     * 得到相应  id  对应的  分类名  数组
     */
    public function getOptions($pid = null, $type = 2) {
        $data = $this->getCategories($pid, $type);
        $tree = $this->getTree($data);
        $list = ['顶级分类'];
        foreach ($tree as $value) {
            $list[$value['id']] = $value['title'];
        }
        return $list;
    }

    /**
     * 获取分类类型
     */
    public function getTypes() {
        $typeList = [1 => "普通文章", 2 => "新闻", 3 => "系统通知", 4 => "系统公告"];
        return $typeList;
    }

}
