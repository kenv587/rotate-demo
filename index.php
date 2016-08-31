<?php
	session_start();
	$action = empty($_REQUEST['a'])?'index':$_REQUEST['a'];
	$allow = array('rotate','save','index');
	if(!in_array($action,$allow)){

		die('非法操作!');
	}elseif($action=='rotate'){

		echo mt_rand(0,7);
	}elseif($action=='save'){
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['phone'] = $_POST['phone'];
	}elseif($action=='index'){?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>抽奖</title>
<style type="text/css">
*{margin:0;padding:0;list-style-type:none;}
a,img{border:0;}
body{font:12px/180% Arial, Helvetica, sans-serif, "新宋体";}
.rotary{position:relative;width:854px;height:504px;margin:50px auto 0 auto;background:#d71f2e url(images/bg1.png);}
.rotaryArrow{position:absolute;left:181px;top:104px;width:294px;height:294px;cursor:pointer;background-image:url(images/arrow.png);}
.list{position:absolute;right:48px;top:144px;width:120px;height:320px;overflow:hidden;}
.list h3{display:none;}
.list li{height:37px;font:14px/37px "Microsoft Yahei";color:#ffea76;text-indent:25px;background:url(images/user.png) 0 no-repeat;}
.result{display:none;position:absolute;left:130px;top:190px;width:395px;height:126px;background-color:rgba(0,0,0,0.75);filter:alpha(opacity=90);}
.result a{position:absolute;right:5px;top:5px;width:25px;height:25px;text-indent:-100px;background-image:url(images/close.png);overflow:hidden;}
.result p{padding:45px 15px 0;font:16px "Microsoft Yahei";color:#fff;text-align:center;}
.result em{color:#ffea76;font-style:normal;}
</style>
</head>
<body>
<!-- Demo start  -->
<div class="rotary">
	<div class="rotaryArrow" id="rotaryArrow"></div>
	<div class="list">
		<h3>中奖名单</h3>
		<ul>
<?php
if(!empty($_SESSION)){

	echo '<li>'.$_SESSION['name'].'&nbsp&nbsp'.$_SESSION['phone'].'</li>';
}
?>
		</ul>
	</div>
	<div class="result" id="result">
		<p id="resultTxt"></p>
		<div id="info" class="" style="display:none;">
			
		<form method="post" action="?a=save" style="text-align:center;">
			
		<input type="text" placeholder="称呼" name="name"><br/>
		<input type="text" placeholder="手机" name="phone"><br/>
		<input type="submit" value="提交">

		</form>
		</div>

		<a href="javascript:" id="resultBtn" title="关闭">关闭</a>
	</div>
</div>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.rotate.min.js"></script>
<script type="text/javascript">

	var $rotaryArrow = $('#rotaryArrow');
	var $result = $('#result');
	var $resultTxt = $('#resultTxt');
	$rotaryArrow.click(function(){
		$.ajax({
			url:'?a=rotate',
			success:function(data){
				roate(data);
		}
		})
	});
function roate(str){
	var num = str;
			switch(num){	
			case '1':
				rotateFunc(1,87,'恭喜您获得了 <em>1</em> 元代金券');
				break;
			case '2':
				rotateFunc(2,43,'恭喜您获得了 <em>5</em> 元代金券');
				break;
			case '3':
				rotateFunc(3,134,'恭喜您获得了 <em>10</em> 元代金券');
				break;
			case '4':
				rotateFunc(4,177,'很遗憾，这次您未抽中奖，继续加油吧');
				break;
			case '5':
				rotateFunc(5,223,'恭喜您获得了 <em>20</em> 元代金券');
				break;
			case '6':
				rotateFunc(6,268,'恭喜您获得了 <em>50</em> 元代金券');
				break;
			case '7':
				rotateFunc(7,316,'恭喜您获得了 <em>30</em> 元代金券');
				break;
			default:
				rotateFunc(0,0,'很遗憾，这次您未抽中奖，继续加油吧');
			}
}


function rotateFunc(awards,angle,text){
		if(awards>'0' && awards!='4'){$('#info').show();}

		$rotaryArrow.stopRotate();
		$rotaryArrow.rotate({
			angle: 0,
			duration: 5000,
			animateTo: angle + 1440,
			callback: function(){
				$resultTxt.html(text);
				$result.show();
			}
		});
	}



</script>
<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">

</div>
</body>
</html>

    
	
	
<?php
}
?>
