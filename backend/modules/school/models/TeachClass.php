<?php
namespace backend\modules\school\models;

use Yii;
use backend\modules\testService\models\Taskline;
use backend\modules\school\models\TeachDepartment;

/**
 * This is the model class for table "teach_class".
 *
 * @property int $id
 * @property string $title
 * @property string $grade
 * @property int $department_id
 * @property int $serial
 * @property string $type
 * @property string $school
 * @property string $note
 */
class TeachClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'grade', 'serial', 'type'], 'required'],
            [['department_id', 'serial'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['grade'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 50],
            [['school'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 500],
        ];
    }


    public function getTaskline()
    {
       return  $this->hasOne(Taskline::className(),['grade'=>'grade','banji'=>'serial']);
    }

    public function getDepartment()
    {
        return $this->hasOne(TeachDepartment::className(),['id'=>'department_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '班级标题',
            'grade' => '年级届次',
            'department_id' => '教学部',
            'type' => '类别',
            'school' => '学校',
            'serial' =>'班级序号',
            'note' => '备注',
        ];
    }
}
