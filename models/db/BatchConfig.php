<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "calls".
 *
 * @property integer $batch_process_id
 * @property string $last_id
 *
 */
class BatchConfig extends ActiveRecord
{

    public $db = null;
    public $records = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batch_process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch_process_id', 'last_id'], 'required'],
            [['batch_process_id', 'last_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'batch_process_id' => 'Id del proceso',
            'last_id' => 'Último Id Procesado',
        ];
    }

    public function getLastId()
    {
        return $this->last_id;
    }

    public function setLastId($lastId)
    {
        return $this->last_id = $lastId;
    }

    public function getBatchProcessId()
    {
        return $this->batch_process_id;
    }

    /**
     * Searches for the batch config of a given process by it's id.
     * @return \app\models\db\BatchConfig
     */
    public function findById($id)
    {
        return self::find()
            ->where(['batch_process_id' => $id])
            ->one();
    }
}