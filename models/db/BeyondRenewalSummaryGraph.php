<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "beyond_renewal_summary_graph".
 *
 * @property date $uploadDate
 * @property date $date
 * @property integer $registries
 * @property integer $calls
 * @property integer $renewed
 *
 */
class BeyondRenewalSummaryGraph extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beyond_renewal_summary_graph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_date', 'date', 'registries', 'calls', 'renewed'], 'required'],
            [['registries', 'calls', 'renewed'], 'integer'],
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
            'registries' => 'Registros',
            'calls' => 'Llamadas',
            'renewed' => 'Renovados',
        ];
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
        $date = new \yii\db\Expression("DATE_FORMAT(upload_date, '%d/%m/%Y') as upload_date, DATE_FORMAT(`date`, '%d/%m/%Y') as `date`, registries, calls, renewed");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->all();
    }
}