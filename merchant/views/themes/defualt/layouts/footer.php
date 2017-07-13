<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginBlock("uijs") ?>
function show(){
var date = new Date(); //日期对象
var now = now1="";
now1 ="<span>"+ date.getFullYear()+"</span>年"; //读英文就行了
now1 = now1 + (date.getMonth()+1)+"月"; //取月的时候取的是当前月-1如果想取当前月+1就可以了
now1 = now1 + date.getDate()+"日";
var a = new Array("日", "一", "二", "三", "四", "五", "六");  
var week = date.getDay();  
var weekstr = "星期"+ a[week];  
now = now + date.getHours()+":";
now = now + date.getMinutes()+":";
if(date.getSeconds()<10){now = now +"0"+ date.getSeconds();}else{now = now + date.getSeconds();}
 $("#weeklabel").html(weekstr); 
 $("#year-month-day").html(now1);
 $("#hour-minute-second").html(now); //div的html是now这个字符串 
setTimeout("show()",100); //设置过1000毫秒就是1秒，调用show方法
}
$(function(){
show();
/*左侧导航栏显示隐藏功能*/
$(".subNav").click(function(){				
			/*显示*/
			if($(this).find("span:first-child").attr('class')=="title-icon glyphicon glyphicon-chevron-down")
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-down");
			    $(this).find("span:first-child").addClass("glyphicon-chevron-up");
			    $(this).removeClass("sublist-down");
				$(this).addClass("sublist-up");
			}
			/*隐藏*/
			else
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-up");
				$(this).find("span:first-child").addClass("glyphicon-chevron-down");
				$(this).removeClass("sublist-up");
				$(this).addClass("sublist-down");
			}	
		// 修改数字控制速度， slideUp(500)控制卷起速度
	    $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
	})
/*左侧导航栏缩进功能*/
$(".left-main .sidebar-fold").click(function(){

	if($(this).parent().attr('class')=="left-main left-full")
	{
		$(this).parent().removeClass("left-full");
		$(this).parent().addClass("left-off");
		
		$(this).parent().parent().find(".right-product").removeClass("right-full");
		$(this).parent().parent().find(".right-product").addClass("right-off");
		

		}
	else
	{
		$(this).parent().removeClass("left-off");
		$(this).parent().addClass("left-full");
		
		$(this).parent().parent().find(".right-product").removeClass("right-off");
		$(this).parent().parent().find(".right-product").addClass("right-full");
		

		}
	})	
 
  /*左侧鼠标移入提示功能*/
		$(".sBox ul li").mouseenter(function(){
			if($(this).find("span:last-child").css("display")=="none")
			{$(this).find("div").show();}
			}).mouseleave(function(){$(this).find("div").hide();})	
})
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["uijs"], \yii\web\View::POS_END); ?>
