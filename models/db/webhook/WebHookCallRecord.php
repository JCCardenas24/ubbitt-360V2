<?php

namespace app\models\db\webhook;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "callpicker_records".
 *
 * @property integer $callPickerRecordId
 * @property string $name
 * @property integer $pkCallpickerId
 *
 */
class WebHookCallRecord extends ActiveRecord
{

    public $db = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callpicker_records';
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
            [['callpicker_record_id', 'name', 'pk_callpicker_id'], 'required'],
            [['callpicker_record_id', 'pk_callpicker_id'], 'integer'],
            [['name',], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'callpicker_record_id' => 'Id de la grabación',
            'name' => 'Nombre del archivo',
        ];
    }

    public function getCallPickerRecordId()
    {
        return $this->callpicker_record_id;
    }

    public function getPkCallpickerId()
    {
        return $this->pk_callpicker_id;
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return \app\models\db\webhook\WebHookCallRecord
     */
    public function findById($id)
    {
        return self::findOne($id);
    }
}