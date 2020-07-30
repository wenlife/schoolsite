<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sign_kszbm".
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property string $birth_place
 * @property string $birth_date
 * @property string $origin_place
 * @property string $minzu
 * @property string $id_card
 * @property string $hukou_place
 * @property string $hukou_type
 * @property float $height
 * @property string $health
 * @property string $address
 * @property int $if_pre_educate
 * @property int $if_sigle
 * @property int $if_alone
 * @property int $if_ls
 * @property string $zk_exam_id
 * @property float $zk_score
 * @property string $zk_school
 * @property string $party_type
 * @property string $speciality
 * @property int $if_live
 * @property int $if_cload
 * @property int $if_en
 * @property int $if_help
 * @property string $dad_name
 * @property string $dad_nation
 * @property string $dad_hukou
 * @property string $dad_idcard
 * @property string $dad_phone
 * @property string $dad_company
 * @property string $dad_duty
 * @property string $mom_name
 * @property string $mom_nation
 * @property string $mom_hukou
 * @property string $mom_idcard
 * @property string $mom_phone
 * @property string $mom_company
 * @property string $mom_duty
 * @property int $if_uniform
* @property string|null $create_time
* @property string|null $update_time
* @property int|null $verify
* @property string|null $verify_time
* @property string|null $verify_admin
* @property string|null $verify_msg
* @property string|null $note
 */
class SignKszbm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sign_kszbm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'birth_place', 'origin_place', 'minzu', 'id_card', 'hukou_place', 'hukou_type', 'height', 'health', 'address', 'if_pre_educate', 'if_sigle', 'if_alone', 'if_ls', 'zk_exam_id', 'zk_score', 'zk_school', 'party_type', 'speciality', 'if_live', 'if_cload', 'if_en', 'if_help', 'dad_name', 'dad_nation','dad_idcard', 'dad_phone', 'dad_company', 'dad_duty', 'mom_name', 'mom_nation', 'mom_idcard', 'mom_phone', 'mom_company', 'mom_duty', 'if_uniform'], 'required'],
            [['height', 'zk_score'], 'number'],
            [['if_pre_educate', 'if_sigle', 'if_alone', 'if_ls', 'if_live', 'if_cload', 'if_en', 'if_help', 'if_uniform', 'verify'], 'integer'],
            [['speciality', 'note'], 'string'],
            [['name', 'gender', 'birth_date', 'minzu', 'id_card', 'hukou_type', 'health', 'zk_exam_id', 'party_type', 'dad_name', 'dad_nation', 'dad_idcard', 'dad_phone', 'dad_duty', 'mom_name', 'mom_nation', 'mom_idcard', 'mom_phone', 'mom_duty', 'create_time', 'update_time', 'verify_time', 'verify_admin'], 'string', 'max' => 50],
            [['birth_place', 'address'], 'string', 'max' => 200],
            [['origin_place', 'hukou_place', 'zk_school', 'dad_hukou', 'dad_company', 'mom_hukou', 'mom_company', 'verify_msg'], 'string', 'max' => 100],
            ['id_card', 'unique', 'targetClass' => '\backend\models\SignKszbm', 'message' => '该身份证号已经存在，请确认自己是否已经报名，如有疑问请电话咨询学校'],
            [['id_card','dad_idcard','mom_idcard'],'match','pattern'=>'/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/','message'=>'身份证号格式不正确！'],
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->birth_date = date('Y-m-d',strtotime(substr($this->id_card, 6, 8)));
            $this->gender = intval(substr($this->id_card, -2, 1))% 2 ? '男' : '女';
            if($insert)
            {
                $this->create_time = date('Y-m-d H:i:s',time());
                $this->update_time = date('Y-m-d H:i:s',time());
            }else{
                $this->update_time = date('Y-m-d H:i:s',time());
            }
            return true;

        }else{
            return false;
        }
    }

    public function getBase()
    {
        return $this->hasOne(SignBase::className(),['kh'=>'zk_exam_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '自动编号',
            'name' => '姓名',
            'gender' => '性别',
            'birth_place' => '出生地',
            'birth_date' => '出生日期',
            'origin_place' => '籍贯',
            'minzu' => '民族',
            'id_card' => '身份证号',
            'hukou_place' => '户口所在地',
            'hukou_type' => '户口类型',
            'height' => '身高(cm)',
            'health' => '健康状况',
            'address' => '家庭地址',
            'if_pre_educate' => '是否接受学前教育',
            'if_sigle' => '是否独生子女',
            'if_alone' => '是否孤儿',
            'if_ls' => '是否烈士优抚子女',
            'zk_exam_id' => '中考考号',
            'zk_score' => '中考总分',
            'zk_school' => '初中毕业学校',
            'party_type' => '政治面貌',
            'speciality' => '特长',
            'if_live' => '是否住校',
            'if_cload' => '是否选择云班',
            'if_en' => '是否选择双语特长',
            'if_help' => '是否需要申请资助',
            'dad_name' => '父亲姓名',
            'dad_nation' => '父亲民族',
            'dad_hukou' => '父亲户口所在地',
            'dad_idcard' => '父亲身份证号',
            'dad_phone' => '父亲电话',
            'dad_company' => '父亲工作单位',
            'dad_duty' => '父亲职务',
            'mom_name' => '母亲姓名',
            'mom_nation' => '母亲民族',
            'mom_hukou' => '母亲户口所在地',
            'mom_idcard' => '母亲身份证号',
            'mom_phone' => '母亲电话',
            'mom_company' => '母亲工作单位',
            'mom_duty' => '母亲工作职务',
            'if_uniform' => '是否同意统一校服',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'verify' => '录取进度',
            'verify_time' => '录取时间',
            'verify_admin' => '录取校验人',
            'verify_msg' => '缴费信息',
            'note' => '备注',
        ];
    }
}
