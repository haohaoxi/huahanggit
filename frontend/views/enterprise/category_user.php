
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <title></title>
    <script type="text/javascript" src="js/jquery-2.2.4.min"></script>
    <style type="text/css">
        li {
            list-style: none;
        }
        #search-container > input {
            width: 100px;
            height: 25px;
        }
        #content {
            width: 800px;
            height: 600px;
            margin-top: 20px;
        }
        .left {
            width: 200px;
            height: 600px;
            border: 1px solid black;
            float: left;
            text-align: center;
        }
        .right {
            width: 596px;
            height: 600px;
            border: 1px solid black;
            border-left: none;
            float: right;
            background: #999999;
        }
        .top {
            width: 200px;
            height: 100px;
            line-height: 100px;
        }
        .middle {
            width: 200px;
            height:50px;
            background: #999999;
            line-height: 50px;
        }
        .bottom {
            margin-top: 40px;
        }
        .right .title {
            width: 560px;
            height: 70px;
        }

        .right .title li {
            width: 110px;
            height: 20px;
            float: left;
        }
        .right-container {
            margin-left: 40px;

        }
    </style>
</head>
<body>
<h3>选择分类模块</h3>
<div id="search-container">

</div>
<div id="content">

    <div class="left" >

        <?php  foreach ($category_id as $key=>$vo){?>

            <div class="top"><input type="hidden" name="<?= $key[0]['category_name'];?>" value="<?= $vo['id'];?>"><?= $vo['category_name'];?></div>
                    <?php  $arr[] = $vo['_child'];?>
        <?php }?>
    </div>

    <div class="right" hidden>


    </div>


</div>
<input type="submit" name="sub" value="提交">
</body>
</html>

<script>
    $(document).ready(function(){
    $('.top, .right').hover(function(){
        var id = $(this.firstChild).val();
        if(id.length!==0){
          $.ajax({
              type:"GET",
              url:'?r=enterprise/ajaxs',
              data:{id:id},
              dataType:"json",
              success:function(data){
                  console.log(data);
                $(".right").html(data['pach']);
              }
          });
        }
        $(".right").css("display", "block");
        //点击分类追加到页面
        $(".title>li").click(function(){
            var livar = $(this).text();    //三级分类的li值
          var inval =  $(this).children().val();  //第三级id
          $("#search-container").append("<input type='text' id='id' name='"+inval+"' value='"+livar+"' disabled='disabled' /><span class='delete'>x    </span>");
        });
        //删除选择元素方法
        $(".delete").click(function(){
            $(this).prev().remove();
            $(this).remove();

        })
    },function(){
        $(".right").css("display", "none");
    });
    //提交
        $(":submit").click(function(){
            if($("#search-container>input").length>0){
                var arr = [];
                    $("#search-container input").each(function(){
                         arr.push($(this).attr('name'));
                    });

                    $.ajax({
                       type:"GET",
                       url:"?r=enterprise/list",
                       data:{arr:arr},
                       dataType:"json",
                       success:function(data){

                       }
                    });
                alert(arr);
            }else{
                alert("请至少选择一个分类提交");
            }
        })

    });


</script>

