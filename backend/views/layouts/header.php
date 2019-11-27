<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini"><i class="fa fa-apple"></i></span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li><?=Html::a('我的主页',['/tcenter/mcenter'])?></li>
                <?php
                    if(Yii::$app->user->can('userPost'))
                    {
                        echo '<li>'.Html::a('教师管理',['/guest/teacher']).'</li>';
                    }
                    if(Yii::$app->user->can('schoolPost'))
                    {
                        echo '<li>'.Html::a('任教管理',['/school/teachmanage']).'</li>';
                        echo '<li>'.Html::a('课程安排',['/school/teachcourse']).'</li>';
                    }
                ?>
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">0</span>
                    </a>

                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">0</span>
                    </a>

                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">0</span>
                    </a>

                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/default.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">退出系统</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="img/seven.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?=Yii::$app->user->identity->username?>
                                <small>攀枝花第七中学 - 高级中学 since Nov. 1981</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
<!--                         <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Teachers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Students</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">详细信息</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出登陆',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
