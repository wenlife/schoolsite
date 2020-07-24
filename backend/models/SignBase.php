<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sign_base".
 *
 * @property int $id 自动编号
 * @property string $kh 考号
 * @property string $xm 姓名
 * @property int|null $xb 性别
 * @property string|null $byzx 毕业中学
 * @property string|null $bjdm 班级代码
 * @property string|null $csny 出生年月
 * @property string|null $lxdh 联系电话
 * @property string|null $txdz 通讯地址
 * @property string|null $sfzh 身份证号
 * @property float|null $yw 语文
 * @property float|null $sx 数学
 * @property float|null $wy 外语
 * @property float|null $wl 物理
 * @property float|null $hx 化学
 * @property float|null $zz 政治
 * @property float|null $ls 历史
 * @property float|null $sw 生物
 * @property float|null $dl 地理
 * @property float|null $sy 实验
 * @property float|null $ty 体育
 * @property float|null $zf 总分
 * @property float|null $lqzf 录取总分
 * @property string|null $lqxx 录取信息
 * @property string|null $bmd 报名点
 * @property int|null $flag 录取标志
 * @property string|null $note 备注
 */
class SignBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sign_base';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kh', 'xm'], 'required'],
            [['xb', 'flag'], 'integer'],
            [['yw', 'sx', 'wy', 'wl', 'hx', 'zz', 'ls', 'sw', 'dl', 'sy', 'ty', 'zf', 'lqzf'], 'number'],
            [['kh', 'xm', 'csny', 'lxdh', 'sfzh'], 'string', 'max' => 20],
            [['byzx', 'lqxx', 'bmd'], 'string', 'max' => 50],
            [['bjdm'], 'string', 'max' => 10],
            [['txdz', 'note'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kh' => '中考考号',
            'xm' => '姓名',
            'xb' => '性别',
            'byzx' => '毕业中学',
            'bjdm' => '班级代码',
            'csny' => '出生年月',
            'lxdh' => '联系电话',
            'txdz' => '通讯地址',
            'sfzh' => '身份证号',
            'yw' => '语文',
            'sx' => '数学',
            'wy' => '外语',
            'wl' => '物理',
            'hx' => '化学',
            'zz' => '政治',
            'ls' => '历史',
            'sw' => '生物',
            'dl' => '地理',
            'sy' => '实验',
            'ty' => '体育',
            'zf' => '总分',
            'lqzf' => '录取总分',
            'lqxx' => '录取信息',
            'bmd' => '报名点',
            'flag' => '录取标志',
            'note' => '备注',
        ];
    }
}
