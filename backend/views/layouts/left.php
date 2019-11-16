<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/avatar/default.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    //主页设置
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '主页','icon' => 'dashboard text-green', 'url' => ['/site/center']],
                    
                    //成绩分析系统
                    ['label' => '系统功能', 'options' => ['class' => 'header']],
                    ['label' => '成绩分析','icon' => 'bar-chart text-red', 'url' => ['/testService/exam']],
                    //选课建议系统
                    //
                    ['label' => '教学安排','icon'=>'calculator text-green','items'=>[
                    ['label' => '学部','icon'=>'calendar text-primary','url' => ['/school/teachdepartment']],
                    ['label' => '学期','icon'=>'calendar text-primary','url' => ['/school/teachyear']],
                    ['label' => '班级','icon'=>'group text-primary','url' => ['/school/teachclass']],
                    ['label' => '任教','icon'=>'user-plus text-primary','url' => ['/school/teachmanage']],
                    ['label' => '作息','icon'=>'clock-o text-primary','url' => ['/school/daytime']],
                    ['label' => '课程数量','icon'=>'calendar text-success','url' => ['/school/teachcourselimit']],
                    ['label' => '课表','icon'=>'calendar text-success','url' => ['/school/teachcourse']],
                    ]],
                    //信息技术练习
                    ['label' => '在线教学','icon'=>'bicycle','items'=>[
                        ['label' => '试题管理','icon'=>'globe', 'url' => ['/test/item']],
                        ['label' => '试卷管理','icon'=>'leaf','url' => ['/test/testpaper']],
                        ['label' => '课堂任务','icon'=>'tasks', 'url' => ['/test/task']],
                    ]],
                    //文章系统
                    ['label' => '信息发布','icon'=>'cubes','items'=>[
                        ['label' => '内容','icon'=>'book','url' => ['/content/contentmenu']],
                        ['label' => '文章','icon'=>'book','url' => ['/content/article']],
                        ['label' => '视频','icon'=>'play', 'url' => ['/content/videolist']],
                        ['label' => '图片','icon'=>'tint', 'url' => ['/content/picturelist']],             
                        ['label' => '栏目', 'icon'=>'tasks','url' => ['/content/infoitem']],
                    ]],
                    ['label' => '系统管理', 'options' => ['class' => 'header']],
                    ['label' => '前台界面','icon'=>'ambulance','items'=>[
                        ['label'=>'置顶图片','icon'=>'fire','url'=>['/interface/logo']],
                        ['label'=>'前台栏目设置','icon'=>'th','url'=>['/interface/setting']],
                        ['label'=>'学生中心通知设置','icon'=>'bell','url'=>['/interface/notice']],
                    ]],
                    ['label' => '系统用户','icon'=>'rocket','items'=>[
                        ['label'=>'管理员','icon'=>'user','url'=>['/guest/adminuser']],
                        ['label'=>'学生','icon'=>'user','url'=> ['/guest/user']],
                        ['label'=>'教师','icon'=>'user text-blue','url' => ['/guest/teacher']],
                       
                    ]],
                    //开发工具
                    ['label' => '工具', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>