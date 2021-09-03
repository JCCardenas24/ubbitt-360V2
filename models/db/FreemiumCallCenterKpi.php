<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "freemium_call_center_kpi".
 *
 * @property date $date
 * @property integer $inboundCalls
 * @property integer $answeredCalls
 * @property integer $outboundCalls
 * @property integer $lostCalls
 * @property integer $callsAnsweredWithin25Seconds
 * @property double $nslPercentage
 * @property integer $abandonedBefore5Seconds
 * @property double $abandonment
 * @property double $ath
 * @property double $averageTimeInAnsweringCall
 * @property string $speakingTime
 *
 */
class FreemiumCallCenterKpi extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freemium_call_center_kpi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'inbound_calls', 'answered_calls', 'outbound_calls', 'lost_calls', 'calls_answered_within_25_seconds', 'nsl_percentage', 'abandoned_before_5_seconds', 'abandonment', 'ath', 'average_time_in_answering_call', 'speaking_time'], 'required'],
            [['inbound_calls', 'answered_calls', 'outbound_calls', 'lost_calls', 'calls_answered_within_25_seconds', 'abandoned_before_5_seconds'], 'integer'],
            [['nsl_percentage', 'ath', 'abandonment', 'average_time_in_answering_call'], 'double'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['speaking_time'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Fecha',
            'inbound_calls' => 'Número de llamadas entrantes',
            'answered_calls' => 'Número de llamadas contestadas',
            'outbound_calls' => 'Número de llamadas salientes',
            'lost_calls' => 'Número de llamadas perdidas ',
            'calls_answered_within_25_seconds' => 'Atendidos antes de 25 segundos',
            'nsl_percentage' => 'NSL (NSL/ NCO)',
            'abandoned_before_5_seconds' => 'ABA Abandonados antes de 5 segundos',
            'abandonment' => '%Abandono (Colgado)',
            'ath' => 'ATH',
            'average_time_in_answering_call' => 'Tiempo promedio en contestar la llamada',
            'speaking_time' => 'Speaking time',
        ];
    }

    public function getInboundCalls()
    {
        return $this->inbound_calls;
    }

    public function setInboundCalls($inboundCalls)
    {
        $this->inbound_calls = $inboundCalls;
    }

    public function getAnsweredCalls()
    {
        return $this->answered_calls;
    }

    public function setAnsweredCalls($answeredCalls)
    {
        $this->answered_calls = $answeredCalls;
    }

    public function getOutboundCalls()
    {
        return $this->outbound_calls;
    }

    public function setOutboundCalls($outboundCalls)
    {
        $this->outbound_calls = $outboundCalls;
    }

    public function getLostCalls()
    {
        return $this->lost_calls;
    }

    public function setLostCalls($lostCalls)
    {
        $this->lost_calls = $lostCalls;
    }

    public function getCallsAnsweredWithin25Seconds()
    {
        return $this->calls_answered_within_25_seconds;
    }

    public function setCallsAnsweredWithin25Seconds($callsAnsweredWithin25Seconds)
    {
        $this->calls_answered_within_25_seconds = $callsAnsweredWithin25Seconds;
    }

    public function getNslPercentage()
    {
        return $this->nsl_percentage;
    }

    public function setNslPercentage($nslPercentage)
    {
        $this->nsl_percentage = $nslPercentage;
    }

    public function getAbandonedBefore5Seconds()
    {
        return $this->abandoned_before_5_seconds;
    }

    public function setAbandonedBefore5Seconds($abandonedBefore5Seconds)
    {
        $this->abandoned_before_5_seconds = $abandonedBefore5Seconds;
    }

    public function getAverageTimeInAnsweringCall()
    {
        return $this->average_time_in_answering_call;
    }

    public function setAverageTimeInAnsweringCall($averageTimeInAnsweringCall)
    {
        $this->average_time_in_answering_call = $averageTimeInAnsweringCall;
    }

    public function getSpeakingTime()
    {
        return $this->speaking_time;
    }

    public function setSpeakingTime($speakingTime)
    {
        $this->speaking_time = $speakingTime;
    }

    public function findByDate()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->one();
    }

    public function findByDates($startDate, $endDate)
    {
        return self::find()
            ->where(['between', 'date', $startDate, $endDate])
            ->all();
    }
}