<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

?>
<?= GridView::widget([
    'dataProvider' => $dataReportFileProvider,
    'columns' => [
        'id',
        // 'file_path',
        [
            'value' => function ($data) {
                $data_arr = explode("/",$data->file_path);
                return sizeof($data_arr) > 1 ?  $data_arr[1] : $data_arr[0];
            },
        ],
        // 'user_id',
        [
            'value' => function ($data) {
                $user = User::findOne($data->user_id);
                return $user ? $user->username : 'N/A';
            },
        ],
        'created_at',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>