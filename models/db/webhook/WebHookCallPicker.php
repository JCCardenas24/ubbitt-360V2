<?php

namespace app\models\db\webhook;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "callpicker".
 *
 * @property integer $id
 * @property string $string
 * @property string $date
 *
 */
class WebHookCallPicker extends ActiveRecord
{
    public $records = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callpicker';
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
            [['id', 'string', 'date'], 'required'],
            [['id'], 'integer'],
            [['string', 'date',], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id de la llamada',
            'string' => 'Info',
            'date' => 'Fecha del registro',
        ];
    }

    /**
     * Finds callpicker records from a given Id
     * @param integer $id Exclusive id
     * @return array[] \app\models\db\webhook\WebHookCalPicker
     */
    public function findFromId($id, $limit)
    {
        return self::find()
            ->where(['>', 'id', $id])
            ->limit($limit)
            ->all();
    }
}