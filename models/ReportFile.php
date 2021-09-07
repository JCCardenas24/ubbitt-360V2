<?php

namespace app\models;
use yii\data\Pagination;

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
            [['file', 'type'], 'required'],
            ['type', 'string', 'max' => '255'],
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
            'type' => 'Tipo',
            'file_path' => 'Archivo',
            'user_id' => 'Usuario',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
            'deleted_at' => 'Fecha de eliminación',
        ];
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return array[] \app\models\ReportFile
     */
    public function findByDate($startDate, $endDate, $page, $type)
    {
        $query = self::find()
            ->where(['between', 'created_at', $startDate . ' 00:00:00', $endDate . ' 23:59:59'])->andWhere(['=', 'type', Yii::$app->params['report_type_dict'][$type]]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'pageSize' => Yii::$app->params['itemsPerPage']]);
        $reports = $query->offset($pages->offset)->limit($pages->limit)->all();
        return [
            'reportsRecords' => $reports,
            'totalPages' => $pages->pageCount
        ];
    }
}
