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
            'file_path' => 'Archivo',
            'user_id' => 'Usuario',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
            'deleted_at' => 'Fecha de eliminación',
        ];
    }
}
