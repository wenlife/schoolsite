<?php
namespace backend\libary;
use Yii;
//use PHPExcel;
use yii\helpers\ArrayHelper;

class CommonFunction{

	static function getNoticepos()
	{
		return ['pos_course'=>'课表系统通知',
		        'pos_ytbm'=>'艺体报名提示信息',
		        'pos_kszbm'=>'跨市州报名提示信息',
		       ];
	}
	static function getLqjd()
	{
		return ['0'=>'未录取','1'=>'可录取/待填表','2'=>'已填写报名表','3'=>'已缴费并录取','4'=>'招生录入','24'=>'异常状态'];
	}
	static function getLqlabel()
	{
		return ['1'=>'label label-default','3'=>'label label-success',
		         '0'=>'label label-danger','2'=>'label label-success','24'=>'label label-danger',];
	}

	static function getNoticelevel()
	{
		return ['alert-success'=>'好消息','alert-info'=>'一般消息',
		         'alert-warning'=>'警告消息','alert-danger'=>'危险警告'];
	}
	static function getLabel()
	{
		return ['0'=>'label label-default','1'=>'label label-success',
		         '2'=>'label label-danger','3'=>'label label-default'];
	}



	static function getVerifyState()
	{
		return ['0'=>'未审核','1'=>'审核通过','2'=>'未通过审核','3'=>'等待重新审核'];
	}


	/*
     该处用于成绩分析
     */

	static function getSubjects()
	{
    	$subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		    'ty'=>'体育','xx'=>'信息','ms'=>'美术',
		    'yu'=>'音乐','zf'=>'总分'
		];
		return $subjects;
	}

    /*
     该处用于教师职责分配
     */
	static function getAllTeachDuty()
	{
		    $subjects = [
		    'bzr'=>'班主任',
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		    'ty'=>'体育','ms'=>'美术','yu'=>'音乐',
		    'xx'=>'信息','tj'=>'通用','ys'=>'艺术',
		    'hq'=>'后勤','xz'=>'行政'
		];
		return $subjects;
	}
    /*
       该处用于教学课程安排
     */
    static function getAllSubjects()
	{
		    $subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		    'ty'=>'体育','ms'=>'美术','yu'=>'音乐',
		    'xx'=>'信息','tj'=>'通用','hd'=>'活动',
		    'ys'=>'艺术'
		];
		return $subjects;
	}

	static function translateSubjects($data)
	{
		$subjects = array_flip(static::getAllSubjects());
		$translated = array();
		foreach ($data as $courses) {
			$temp = [];
			foreach ($courses as $title => $course) {
				if($c_en = ArrayHelper::getValue($subjects,trim($course)))
				{
					$temp[$title] = $c_en;
				}        
			}
            count($temp)>0?array_push($translated,$temp):0;
		}
		return $translated;
	}

	static function getWeekday()
	{
		return ['1'=>'星期一','2'=>'星期二','3'=>'星期三','4'=>'星期四','5'=>'星期五','6'=>'星期六','7'=>'星期天'];
		//return ['1'=>'星期一','2'=>'星期二','3'=>'星期三','4'=>'星期四','5'=>'星期五'];
	}

	static function getLksubjects()
	{
		$subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'wl'=>'物理','hx'=>'化学','sw'=>'生物',
		];
		return $subjects;
	}

	static function getWksubjects()
	{
		$subjects = [
		    'yw'=>'语文','ds'=>'数学','yy'=>'英语',
		    'zz'=>'政治','ls'=>'历史','dl'=>'地理',
		];
		return $subjects;
	}

	static function getClassType()
	{
		return ['lk'=>'理科','wk'=>'文科'];
	}

	static function getTeacherType()
	{
		return ['js'=>'教师','ma'=>'管理员'];
	}

	static function getSchool()
	{
		return ['市七中'=>"市七中"];
	}

	static function gradelist()
	{
	    $year = date('Y');
	    $yearRange = range($year-3,$year+3);
	    foreach ($yearRange as $key => $value) {
	        $gradelist[$value] = $value.'届';
	    }
	    return $gradelist;
	}

    
    static function getCat11()
    {
    	return ['ty'=>'体育','yy'=>'音乐'];
    }

	static function getCat21()
	{
        return ['田径'=>'田径','女子排球'=>'女子排球','男子排球'=>'男子排球','女子足球'=>'女子足球'];
	}

	static function getCat22()
	{
		return ['声乐-民族唱法'=>'声乐-民族唱法','声乐-美声唱法'=>'声乐-美声唱法',
          '钢琴'=>'钢琴','舞蹈-古典舞'=>'舞蹈-古典舞','舞蹈-民族舞'=>'舞蹈-民族舞',
           '舞蹈-民间舞'=>'舞蹈-民间舞','舞蹈-现代舞(非街舞、拉丁舞)'=>'舞蹈-现代舞(非街舞、拉丁舞)'];

	}

	static function getCat31()
	{
		return ['100m'=>'100m','200m'=>'200m','400m'=>'400m','800m'=>'800m','1500m'=>'1500m',
          '女子100米栏'=>'女子100米栏（间距8.5米，栏高0.84米）',
          '男子110米栏'=>'男子110米栏（间距9.14米，栏高1.00米）',
          '跳高'=>'跳高','跳远'=>'跳远','三级跳远'=>'三级跳远',
          '铅球'=>'铅球（女：4kg，男：5kg）','铁饼'=>'铁饼（女：1kg，男：1.5kg）',
          '标枪'=>'标枪（女：600g，男：700g）'];
	}

    //==========================================
}


?>