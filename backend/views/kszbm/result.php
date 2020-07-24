<?php
use yii\helpers\Html;
?>
<div class="box box-primary">
<div class="box-header with-border">
	报名情况查询
</div>
    <!-- /.box-header -->
<div class="box-body">

	<table class="table table-bordered">
	<thead>
		<tr><th>中考考号</th><th>姓名</th>
			<th>录取总分</th><th>录取信息</th><th>可用操作</th></tr>
		<tr><td><?=$result->kh?></td>
			<td><?=$result->xm?></td>
		    <td><?=$result->lqzf?></td>
		    <td><?=$result->lqxx?></td>
		    <td><?=Html::a('填写报名登记表',['report','id'=>$result->id],['class'=>"btn btn-primary"]);?></td>
		</tr>
	</thead>
</table>
</div>
</div>