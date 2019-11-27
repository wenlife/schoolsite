<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // 添加 "createPost" 权限
        $contentPost = $auth->createPermission('contentPost');
        $contentPost->description = '管理文章';
        $auth->add($contentPost);

                // 添加 "createPost" 权限
        $testPost = $auth->createPermission('testPost');
        $testPost->description = '管理在线测试';
        $auth->add($testPost);

                // 添加 "createPost" 权限
        $analysisPost = $auth->createPermission('analysisPost');
        $analysisPost->description = '管理成绩分析';
        $auth->add($analysisPost);

         $coursePost = $auth->createPermission('coursePost');
        $coursePost->description = '管理课程安排';
        $auth->add($coursePost);    

        $schoolPost = $auth->createPermission('schoolPost');
        $schoolPost->description = '管理学校配置';
        $auth->add($schoolPost);

        $userPost = $auth->createPermission('userPost');
        $userPost->description = '管理用户';
        $auth->add($userPost);   

        // 添加 "updatePost" 权限
        // $updatePost = $auth->createPermission('updatePost');
        // $updatePost->description = 'Update post';
        // $auth->add($updatePost);

        // 添加 "author" 角色并赋予 "createPost" 权限
        $contentManager = $auth->createRole('contentManager');
        $contentManager->description = '文章系统管理员';
        $auth->add($contentManager);
        $auth->addChild($contentManager, $contentPost);

        $iteacher = $auth->createRole('iteacher');
        $iteacher->description = '信息技术教师';
        $auth->add($iteacher);
        $auth->addChild($iteacher, $testPost);

        $scoreManager = $auth->createRole('scoreManager');
        $scoreManager->description = '成绩分析管理员';
        $auth->add($scoreManager);
        $auth->addChild($scoreManager, $analysisPost);

        $courseManager = $auth->createRole('courseManager');
        $courseManager->description = '课程系统管理员';
        $auth->add($courseManager);
        $auth->addChild($courseManager, $coursePost);

        $schoolManager = $auth->createRole('schoolManager');
        $schoolManager->description = '学校信息管理员';
        $auth->add($schoolManager);
        $auth->addChild($schoolManager, $schoolPost);

        $userManager = $auth->createRole('userManager');
        $userManager->description = '用户管理员';
        $auth->add($userManager);
        $auth->addChild($userManager, $userPost);



        
        // 添加 "admin" 角色并赋予 "updatePost" 
		// 和 "author" 权限
        $admin = $auth->createRole('admin');
        $admin->description = '站点超级管理员';
        $auth->add($admin);
       // $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $contentManager);
        $auth->addChild($admin, $iteacher);
        $auth->addChild($admin, $scoreManager);
        $auth->addChild($admin, $courseManager);
        $auth->addChild($admin, $schoolManager);
        $auth->addChild($admin, $userManager);


        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($admin, 1);
       // $auth->assign($admin, 1);
    }
}