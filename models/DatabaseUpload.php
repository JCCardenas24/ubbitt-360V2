<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "database_uploads".
 *
 * @property int $id
 * @property string|null $module_origin
 * @property string|null $submodule_origin
 * @property string|null $file_path
 * @property int|null $user_id
 * @property string|null $created_at
 */
class DatabaseUpload extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'database_uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file', 'module_origin', 'submodule_origin'], 'required'],
            [['module_origin'], 'string', 'max' => 50],
            [['submodule_origin'], 'string', 'max' => 50],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_origin' => 'Module Origin',
            'submodule_origin' => 'Submodule Origin',
            'file_path' => 'File Path',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
}
