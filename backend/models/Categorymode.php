<?php
namespace backend\models;

use common\models\Category;

/**
* 通用的树型类，可以生成任何树型结构
*/
/*
功能:基于TP2.0的无限分类。
用法:
第一种用法,不采用数据库,可以不需要TP，例子如下
<?php
require('Category.class.php');//导入Category.class.php类
//测试数据
$data[]=array('cat_id'=>1,'pid'=>0,'name'=>'中国');
$data[]=array('cat_id'=>2,'pid'=>0,'name'=>'美国');
$data[]=array('cat_id'=>3,'pid'=>0,'name'=>'韩国');
$data[]=array('cat_id'=>4,'pid'=>1,'name'=>'北京');
$data[]=array('cat_id'=>5,'pid'=>1,'name'=>'上海');
$data[]=array('cat_id'=>6,'pid'=>1,'name'=>'广西');
$data[]=array('cat_id'=>7,'pid'=>6,'name'=>'桂林');
$data[]=array('cat_id'=>8,'pid'=>6,'name'=>'南宁');
$data[]=array('cat_id'=>9,'pid'=>6,'name'=>'柳州');
$data[]=array('cat_id'=>10,'pid'=>2,'name'=>'纽约');
$data[]=array('cat_id'=>11,'pid'=>2,'name'=>'华盛顿');
$data[]=array('cat_id'=>12,'pid'=>3,'name'=>'首尔');
$cat=new Category('',array('cat_id','pid','name','cname'));
$s=$cat->getTree($data);//获取分类数据树结构
//$s=$cat->getTree($data,1);获取pid=1所有子类数据树结构
foreach($s as $vo)
{
echo $vo['cname'].'<br>';
}
第二种用法,采用数据库,基于TP,例子如下
数据表,前缀_articlec_cat,包含cat_id,pid,title三个字段
require('Category.class.php');//导入Category.class.php类
$cat=new Category('ArticleCat',array('cat_id','pid','title','fulltitle'));
$s=$cat->getList();//获取分类结构
$s=$cat->getList('',1);//获取pid=1的子分类结构
$s=$cat->getList($condition,1);//$condition为查询条件，获取pid=1的子分类结构
$s=$cat->getPath(3);//获取分类id=3的路径
$s=$cat->add($data);//添加分类，$data需要包含上级分类pid
$s=$cat->edit($data);//修改分类,$data需要包含分类ID
$s=$cat->del(10);//删除分类id=10的分类
详细用法：参考代码说明
/**
+------------------------------------------------------------------------------
* 分类管理
+------------------------------------------------------------------------------
*/
class Categorymode
{
    //原始的分类数据
    private $rawList = array();
    //格式化后的分类
    private $formatList = array();
    //错误信息
    private $error = "";
    //格式化的字符
    private $icon = array('&nbsp&nbsp│', '&nbsp&nbsp├ ', '&nbsp&nbsp└ ');
    //字段映射，分类id，上级分类pid,分类名称title,格式化后分类名称fulltitle
    private $field = array();

    /*
    功能：构造函数，对象初始化；
    属性：public;
    参数：$model,数组或对象，基于TP2.0的数据表模型名称,若不采用TP2.0，可传递空值。
    $field，字段映射，分类id，上级分类pid,分类名称title,格式化后分类名称fulltitle
    依次传递,例如在分类数据表中，分类id，字段名为CatID,上级分类pid,字段名称name,希望格式化分类后输出cname,
    则，传递参数为,$field('CatID','pid','name','cname');若为空，则采用默认值。
    返回：无
    备注:用到了TP的D函数
    */

    public function __construct($model = '', $field = array())
    {
        $this->field['id']        = $field['0'] ? $field['0'] : 'id';
        $this->field['pid']       = $field['1'] ? $field['1'] : 'pid';
        $this->field['title']     = $field['2'] ? $field['2'] : 'title';
        $this->field['fulltitle'] = $field['3'] ? $field['3'] : 'fulltitle';
    }

    /*
    功能：返回给定上级分类$pid的所有同一级子分类；
    属性：public;
    参数：上级分类$pid；
    返回：子分类，二维数组；
    备注:
    */

    public function getChild($pid)
    {
        $childs = array();

        foreach ($this->rawList as $Category) {
            if ($Category[$this->field['pid']] == $pid)
                $childs[] = $Category;
        }
        return $childs;
    }

    /*
    功能：无限分类核心部分，递归格式化分类前的字符；
    属性：private;
    参数：分类id,前导空格；
    返回：无；
    备注:
    */

    private function _searchList($CatID = 0, $space = "")
    {

        //下级分类的数组
        $childs = $this->getChild($CatID);
        //如果没下级分类，结束递归
        if (!($n = count($childs)))
            return;
        $cnt = 1;
        //循环所有的下级分类
        for ($i = 0; $i < $n; $i++) {
            $pre = "";
            $pad = "";
            if ($n == $cnt) {
                $pre = $this->icon[2];
            } else {
                $pre = $this->icon[1];
                $pad = $space ? $this->icon[0] : "";
            }
            $childs[$i][$this->field['fulltitle']] = ($space ? $space . $pre : "") . $childs[$i][$this->field['title']];
            $this->formatList[]                    = $childs[$i];
            //递归下一级分类
            $this->_searchList($childs[$i][$this->field['id']], $space . $pad . "&nbsp;&nbsp;");
            $cnt++;
        }
    }



    public function getList($condition = NULL, $CatID = 0, $orderby = NULL)
    {
        $this->_searchList($CatID);
        return $this->formatList;
    }

    /*
    参数：$data，二维数组，起始分类id,默认$CatID=0；
    返回：递归格式化分类数组；
    备注:
    */

    public function getTree($data, $CatID = 0)
    {

        $this->rawList = $data;
        $this->_searchList($CatID);

        return $this->formatList;
    }

    /*
    功能：获取错误信息；
    属性：public;
    参数：无；
    返回：错误信息字符串；
    备注:
    */

    public function getError()
    {
        return $this->error;
    }

    /*
    * 递归获取ids
    * @param $id
    */
    public static function get_ids($id,&$ids=""){
        $data = Category::find()->select('id')->where(['pid'=>$id])->asArray()->all();
        $data = array_column($data,'id');
        if(count($data) != 0) $ids .= implode(',',$data).',';
        foreach($data as $value){
            self::get_ids($value,$ids);
        }
        return $ids;
    }

}
?>