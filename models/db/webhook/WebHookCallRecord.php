<?php

namespace app\models\db\webhook;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callpicker_records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pk_callpicker_id'], 'required'],
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

    public function setPkCallpickerId($pkCallpickerId)
    {
        return $this->pk_callpicker_id = $pkCallpickerId;
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