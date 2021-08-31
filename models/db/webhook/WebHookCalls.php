<?php

namespace app\models\db\webhook;

use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "Permission".
 *
 * @property integer $callId
 * @property string $status
 * @property string $type
 * @property string $dialedBy
 * @property string $answeredBy
 * @property string $dialedNumber
 * @property string $callpickerNumber
 * @property double $duration
 * @property integer $pkCallpickerId
 * @property string $date
 *
 */
class WebHookCalls extends ActiveRecord
{

    public $db = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calls';
    }

    /**
     * {@inheritDoc}
     */
    public static function getDb()
    {
        return Yii::$app->webhookDb;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['call_id', 'status', 'type', 'dialed_by', 'answered_by', 'dialed_number', 'callpicker_number', 'duration', 'pk_callpicker_id', 'date'], 'required'],
            [['call_id', 'dialed_number', 'callpicker_number', 'pk_callpicker_id'], 'integer'],
            [['duration',], 'double'],
            [['status', 'type', 'dialed_by', 'answered_by',], 'string'],
            [['date',], 'datetime'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'call_id' => 'Id de la llamada',
            'status' => 'Estatus',
            'type' => 'Tipo',
            'dialed_by' => 'Marcado por',
            'answered_by' => 'Contestada por',
            'dialed_number' => 'Teléfono marcado',
            'callpicker_number' => 'Teléfono recibido',
            'duration' => 'Duración',
            'date' => 'Fecha de la llamada',
        ];
    }

    public function getCallId()
    {
        return $this->call_id;
    }

    public function getDialedBy()
    {
        return $this->dialed_by;
    }

    public function getAnsweredBy()
    {
        return $this->answered_by;
    }

    public function getDialedNumber()
    {
        return $this->dialed_number;
    }

    public function getCallpickerNumber()
    {
        return $this->callpicker_number;
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return \app\models\db\webhook\WebHookCalls
     */
    public function findById($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return array[] \app\models\db\webhook\WebHookCalls
     */
    public function findByDate($phoneNumber, $startDate, $endDate, $page)
    {
        $query = self::find()
            ->where(['between', 'date', $startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->andWhere(['like', 'callpicker_number', $phoneNumber]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'pageSize' => Yii::$app->params['itemsPerPage']]);
        $calls = $query->offset($pages->offset)->limit($pages->limit)->all();
        return [
            'callsRecords' => $calls,
            'totalPages' => $pages->pageCount
        ];
    }
}