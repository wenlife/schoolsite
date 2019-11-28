<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;
$this->title = '';

?>
 <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
           <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">欢迎来到管理员中心！</h3>
            </div>
            <div class="box-body">
              <a class="btn btn-app" href="<?=Url::toRoute(['/tcenter/index'])?>">
                <i class="fa fa-home"></i> 主页
              </a>
              <a class="btn btn-app" href="<?=Url::toRoute(['/guest/teacher'])?>">
                <i class="fa fa-user"></i> 教师
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/school/teachdepartment'])?>">
                <i class="fa fa-institution text-success"></i>学部
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/school/teachyear'])?>">
                <i class="fa fa-calendar text-success"></i>学期
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/school/teachmanage'])?>">
                <i class="fa fa-binoculars text-primary"></i> 任教
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/school/daytime'])?>">
                <!-- <span class="badge bg-yellow">3</span> -->
                <i class="fa fa-list-alt text-success"></i> 作息
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/school/teachcourse'])?>">
                <!-- <span class="badge bg-green">300</span> -->
                <i class="fa fa-table text-primary"></i> 课程
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/guest/adminuser'])?>">
                <!-- <span class="badge bg-purple">891</span> -->
                <i class="fa fa-user-md"></i> 管理员
              </a>
              <a class="btn btn-app"  href="<?=Url::toRoute(['/guest/user'])?>">
                <!-- <span class="badge bg-teal">67</span> -->
                <i class="fa fa-users"></i> 学生
              </a>
              <a class="btn btn-app">
                <span class="badge bg-aqua">0</span>
                <i class="fa fa-envelope"></i> 信息
              </a>
              <a class="btn btn-app">
                <span class="badge bg-red">531</span>
                <i class="fa fa-heart-o"></i> Likes
              </a>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.row -->



      <!-- Main row -->
      <div class="row">
            
          <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="img/seven.jpg" alt="User profile picture">

              <h3 class="profile-username text-center"><?=$myself->name?></h3>

              <p class="text-muted text-center"><?=$myself->school?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>类型</b> 
                  <a class="pull-right">
                  	<?=ArrayHelper::getValue(CommonFunction::getTeacherType(),$myself->type)?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>学科</b> <a class="pull-right">
                    <?=ArrayHelper::getValue(CommonFunction::getAllSubjects(),$myself->subject)?>
                  	</a>
                </li>
                <li class="list-group-item">
                  <b>用户名</b> <a class="pull-right"><?=$myself->username?></a>
                </li>
              </ul>

              <a href="index.php?r=tcenter" class="btn btn-primary btn-block"><b>教师主页</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">我的信息</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- Left col -->
        <div class="col-md-9">
          <div class="row">
          <div class="col-md-6">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">我的课表</h3>
              
              <div class="box-tools pull-right">
                <a href="index.php?r=test/task" title="点击管理全部任务"></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>内容</th>
                    <th>测试</th>
                    <th>测试完成数</th>
                     <th>具体</th>
                  </tr>
                  </thead>
                  <tbody>

             
                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>

          </div>
          <div class="col-md-6">
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">班级课表</h3>
              
              <div class="box-tools pull-right">
                <a href="index.php?r=test/task" title="点击管理全部任务"></a>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>内容</th>
                    <th>测试</th>
                    <th>测试完成数</th>
                     <th>具体</th>
                  </tr>
                  </thead>
                  <tbody>

             
                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>

          </div>

      <div class="col-md-6">
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">服务器信息</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                  <li>操作系统 <?=php_uname()?></li>
                  <li>PHP版本 <?=PHP_VERSION?></li>
                  <li>PHP运行 <?=php_sapi_name() ?></li>
                  <li>YII版本 <?=Yii::getVersion()?></li>
                  <li><span id="nowTime"></span> 
                  </li>
                
    
              
              <script language="JavaScript">
                document.write("<li>浏览器名称: "+navigator.appName+"</li>");
                document.write("<li>浏览器版本号: "+navigator.appVersion+"</li>");
                document.write("<li>系统语言: "+navigator.systemLanguage+"</li>");
                document.write("<li>系统平台: "+navigator.platform+"</li>");
                document.write("<li>浏览器是否支持cookie: "+navigator.cookieEnabled+"</li>");
              </script>
              </ul>
              <!-- /.table-responsive -->
            </div>

          </div>

          <!-- /.box -->

          </div>
      <div class="col-md-6">
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">系统日志</h3>
              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body">
            </div>
          </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <style type="text/css">
    .boxlink{
      color:white; 
    }
    a.boxlink:hover{
      color:blue; 
    }
  </style>

  <script type="text/javascript">
    function current(){ 
  var  d  = new Date();
  var str = '系统时间：'; 
    str +=d.getFullYear()+'年'; //获取当前年份 
    str +=d.getMonth()+1+'月'; //获取当前月份（0——11） 
    str +=d.getDate()+'日'; 
    str +=d.getHours()+'时'; 
    str +=d.getMinutes()+'分'; 
    str +=d.getSeconds()+'秒'; 
  return str; 
} 
setInterval(function(){$("#nowTime").html(current)},1000); 
</script> 
