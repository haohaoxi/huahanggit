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
<h3>发布商品</h3>
<div id="content">
    <div class="left">
        <?php if(count($category ==0)){?>
            <?php foreach ($category as $key=>$vo){?>
                <div class="top"><input type="hidden" name="<?= $vo['id'];?>" value="<?= $vo['id'];?>"><?= $vo['category_name'];?></div>
                <?php }?>
        <?php }else{ echo "暂时没有数据";}?>
    </div>
    <div class="right" >


    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.top, .right,.right-container').hover(function(){
            var id = $(this.firstChild).val();
//            alert(id);
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
            $(".title>li").click(function(){
                var inval =  $(this).children().val();  //第三级id
                if(inval!==0){
                    $.ajax({
                       type:"GET",
                        url:"?r=demand/ajax",
                        data:{inval:inval},
                        dataType:"json",
                        success:function(data){
                        }
                    });
                }else{
                    alert("参数错误请重新提交");
                }


            });
        },function(){
            $(".right").css("display", "none");
        });

    });


</script>
