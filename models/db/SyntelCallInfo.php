<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "syntel_call_info".
 *
 * @property integer $pkCall
 * @property string $callType
 * @property string $callPurpose
 * @property string $callStart
 * @property string $callEnd
 * @property string $trackerName
 * @property string $stepName
 * @property string $callpickerNumber
 *
 */
class SyntelCallInfo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'syntel_call_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_call', 'call_type', 'call_purpose', 'call_purpose'], 'required'],
            [['call_start', 'call_end',], 'datetime', 'format' => 'php:Y-m-d H:i'],
            [['tracker_name', 'step_name', 'callpicker_number'], 'string'],
        ];
    }

    public function getPkCall()
    {
        return $this->pk_call;
    }

    public function setPkCall($pkCall)
    {
        $this->pk_call = $pkCall;
    }

    public function getCallType()
    {
        return $this->call_type;
    }

    public function setCallType($callType)
    {
        $this->call_type = $callType;
    }

    public function getCallPurpose()
    {
        return $this->call_purpose;
    }

    public function setCallPurpose($callPurpose)
    {
        $this->call_purpose = $callPurpose;
    }

    public function getCallStart()
    {
        return $this->call_start;
    }

    public function setCallStart($callStart)
    {
        $this->call_start = $callStart;
    }

    public function getCallEnd()
    {
        return $this->call_end;
    }

    public function setCallEnd($callEnd)
    {
        $this->call_end = $callEnd;
    }

    public function getTrackerName()
    {
        return $this->tracker_name;
    }

    public function setTrackerName($trackerName)
    {
        $this->tracker_name = $trackerName;
    }

    public function getStepName()
    {
        return $this->step_name;
    }

    public function setStepName($stepName)
    {
        $this->step_name = $stepName;
    }

    public function getCallpickerNumber()
    {
        return $this->callpicker_number;
    }

    public function setCallpickerNumber($callpickerNumber)
    {
        $this->callpicker_number = $callpickerNumber;
    }

    /**
     * Finds a Syntel Call Info by its id
     * @param integer $id
     * @return \app\models\db\SyntelCallInfo
     */
    public function findById($id)
    {
        return self::findOne($id);
    }
}