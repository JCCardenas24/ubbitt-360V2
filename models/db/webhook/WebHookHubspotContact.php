<?php

namespace app\models\db\webhook;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "hubspot_contacts".
 *
 *
 */
class WebHookHubspotContact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hubspot_contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['hubspot_contact_id', 'name', 'lastname', 'email', 'assigned_acount', 'pk_callpicker_id'], 'required'],
            [['hubspot_contact_id', 'pk_callpicker_id'], 'integer'],
            [['name', 'lastname', 'email', 'assigned_acount',], 'string'],
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
}