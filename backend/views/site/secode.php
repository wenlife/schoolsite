<?php
use yii\helpers\Html;
echo Html::a('<<返回注册',['site/signup']);
?>

<h1>安全码查看</h1>

<small>该页面将在网站接入互联网后取消，届时请各位老师联系管理员获取安全码</small>
<table>
<thead>
	<tr>
		<th>姓名</th>
		<th>科目</th>
		<th>安全码</th>
	</tr>
</thead>	
<?php
foreach ($secode as $key => $value) {
	echo "<tr>";
	echo "<td>".$value->name."</td>";
	echo "<td>".$value->subject."</td>";
	echo "<td>".$value->secode."</td>";
	echo "</tr>";
}

?>
</table>

<style type="text/css">
table{
	border:1px solid #ccc;
}
th{
	font-size: 20px;
}
th,td{
	width:100px;
	height: 20px;
	text-align: center;
	border-bottom:1px solid #ccc;
	border-right:1px solid #ccc;
}
a{
	font-size: 40px;
    text-decoration: none;
	padding: 10px 0px 0px 500px;
	position: fixed;
	width: 300px;
}
</style>