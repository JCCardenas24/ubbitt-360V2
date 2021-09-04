<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

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

    public function findKpisReport($startDate, $endDate)
    {
        $data = Yii::$app->db->createCommand('
            SELECT COALESCE(SUM(inbound_calls), 0) AS inbound_calls,
                COALESCE(SUM(answered_calls), 0) AS answered_calls,
                COALESCE(SUM(outbound_calls), 0) AS outbound_calls,
                COALESCE(SUM(outbound_calls), 0) AS outbound_calls,
                COALESCE(SUM(lost_calls), 0) AS lost_calls,
                COALESCE(SUM(calls_answered_within_25_seconds), 0) AS calls_answered_within_25_seconds,
                COALESCE(CAST(AVG(nsl_percentage) AS DECIMAL(5,2)), 0) AS nsl_percentage,
                COALESCE(SUM(abandoned_before_5_seconds), 0) AS abandoned_before_5_seconds,
                COALESCE(CAST(AVG(abandonment) AS DECIMAL(5,2)), 0) AS abandonment,
                COALESCE(CAST(AVG(ath) AS DECIMAL(5,2)), 0) AS ath,
                COALESCE(CAST(AVG(average_time_in_answering_call) AS DECIMAL(5,2)), 0)
                    AS average_time_in_answering_call
                FROM freemium_call_center_kpi
                WHERE date BETWEEN :startDate AND :endDate', [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->queryOne();
        $data['speaking_time'] = $this->findSpeakingTimeSum($startDate, $endDate);
        return $data;
    }

    private function findSpeakingTimeSum($startDate, $endDate)
    {
        $kpis = self::find()
            ->select('speaking_time')
            ->where(['between', 'date', $startDate, $endDate])
            ->all();
        $minutesSum = 0;
        $secondsSum = 0;
        if ($kpis != null) {
            foreach ($kpis as $kpi) {
                $hoursTime = explode(':', $kpi->speakingTime);
                $minutesSum += intval($hoursTime[0]);
                $secondsSum += intval($hoursTime[1]);
            }
            $hoursFromMinutes = intdiv($secondsSum, 60);
            $secondsSum -= $hoursFromMinutes * 60;
            $minutesSum += $hoursFromMinutes;
        }
        $minutesSum = sprintf('%02d', $minutesSum);
        $secondsSum = sprintf('%02d', $secondsSum);
        return "$minutesSum:$secondsSum";
    }
}