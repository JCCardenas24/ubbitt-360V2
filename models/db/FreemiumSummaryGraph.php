<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "freemium_summary_graph".
 *
 * @property date $uploadDate
 * @property date $date
 * @property integer $leads
 * @property integer $calls
 * @property integer $sales
 * @property integer $collected
 *
 */
class FreemiumSummaryGraph extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freemium_summary_graph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_date', 'date', 'leads', 'calls', 'sales', 'collected'], 'required'],
            [['leads', 'calls', 'sales', 'collected'], 'integer'],
            [['upload_date', 'date'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_date' => 'Fecha de carga',
            'date' => 'Fecha',
            'leads' => 'Leads',
            'calls' => 'Llamadas',
            'sales' => 'Ventas',
            'collected' => 'Cobrado',
        ];
    }

    public function beforeSave($insert)
    {
        $this->upload_date = Yii::$app->formatter->asDatetime(strtotime($this->upload_date), "php:Y-m-d");
        return parent::beforeSave($insert);
    }

    public function getUploadDate()
    {
        return $this->upload_date;
    }

    public function setUploadDate($uploadDate)
    {
        $this->upload_date = $uploadDate;
    }

    public function findByDate()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->one();
    }

    public function findByDates($startDate, $endDate)
    {
        $date = new \yii\db\Expression("DATE_FORMAT(upload_date, '%d/%m/%Y') as upload_date, DATE_FORMAT(`date`, '%d/%m/%Y') as `date`, leads, calls, sales, collected");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->all();
    }
}