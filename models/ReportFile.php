<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_files".
 *
 * @property int $id
 * @property string|null $file_path
 * @property int|null $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class ReportFile extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_path' => 'File Path',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
