<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_region_data".
 *
 * @property integer $campaignId
 * @property date $date
 *
 */
class PremiumRegionData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_region_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'aguascalientes', 'baja_california', 'baja_california_sur', 'campeche', 'chiapas', 'chihuahua', 'coahuila_de_zaragoza', 'colima', 'cdmx', 'durango',
                'guanajuato', 'guerrero', 'hidalgo', 'jalisco', 'michoacan_de_ocampo', 'morelos', 'nayarit', 'nuevo_leon', 'oaxaca', 'puebla', 'queretaro_arteaga', 'quintana_roo', 'san_luis_potosi',
                'sinaloa', 'sonora', 'estado_de_mexico', 'tabasco', 'tamaulipas', 'tlaxcala', 'veracruz', 'yucatan', 'zacatecas'
            ], 'required'],
            [[
                'campaign_id', 'aguascalientes', 'baja_california', 'baja_california_sur', 'campeche', 'chiapas', 'chihuahua', 'coahuila_de_zaragoza', 'colima', 'cdmx', 'durango',
                'guanajuato', 'guerrero', 'hidalgo', 'jalisco', 'michoacan_de_ocampo', 'morelos', 'nayarit', 'nuevo_leon', 'oaxaca', 'puebla', 'queretaro_arteaga', 'quintana_roo', 'san_luis_potosi',
                'sinaloa', 'sonora', 'estado_de_mexico', 'tabasco', 'tamaulipas', 'tlaxcala', 'veracruz', 'yucatan', 'zacatecas'
            ], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'date' => 'Fecha',
            'aguascalientes' => 'Aguascalientes',
            'baja_california' => 'Baja California',
            'baja_california_sur' => 'Baja California Sur',
            'campeche' => 'Campeche',
            'chiapas' => 'Chiapas',
            'chihuahua' => 'Chihuahua',
            'coahuila_de_zaragoza' => 'Coahuila de Zaragoza',
            'colima' => 'Colima',
            'cdmx' => 'CDMX',
            'durango' => 'Durango',
            'guanajuato' => 'Guanajuato',
            'guerrero' => 'Guerrero',
            'hidalgo' => 'Hidalgo',
            'jalisco' => 'Jalisco',
            'michoacan_de_ocampo' => 'Michoacan de Ocampo',
            'morelos' => 'Morelos',
            'nayarit' => 'Nayarit',
            'nuevo_leon' => 'Nuevo Leon',
            'oaxaca' => 'Oaxaca',
            'puebla' => 'Puebla',
            'queretaro_arteaga' => 'Queretaro Arteaga',
            'quintana_roo' => 'Quintana Roo',
            'san_luis_potosi' => 'San Luis Potosi',
            'sinaloa' => 'Sinaloa',
            'sonora' => 'Sonora',
            'estado_de_mexico' => 'Estado de México',
            'tabasco' => 'Tabasco',
            'tamaulipas' => 'Tamaulipas',
            'tlaxcala' => 'Tlaxcala',
            'veracruz' => 'Veracruz',
            'yucatan' => 'Yucatan',
            'zacatecas' => 'Zacatecas'
        ];
    }

    public function getCampaignId()
    {
        return $this->campaign_id;
    }

    public function setCampaignId($campaignId)
    {
        $this->campaign_id = $campaignId;
    }

    public function getUploadDate()
    {
        return $this->upload_date;
    }

    public function setUploadDate($uploadDate)
    {
        $this->upload_date = $uploadDate;
    }

    public function findExisting()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->andWhere(['campaign_id' => $this->campaignId])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
            SELECT
                COALESCE(SUM(aguascalientes), 0) AS aguascalientes,
                COALESCE(SUM(baja_california), 0) AS baja_california,
                COALESCE(SUM(baja_california_sur), 0) AS baja_california_sur,
                COALESCE(SUM(campeche), 0) AS campeche,
                COALESCE(SUM(chiapas), 0) AS chiapas,
                COALESCE(SUM(chihuahua), 0) AS chihuahua,
                COALESCE(SUM(coahuila_de_zaragoza), 0) AS coahuila_de_zaragoza,
                COALESCE(SUM(colima), 0) AS colima,
                COALESCE(SUM(cdmx), 0) AS cdmx,
                COALESCE(SUM(durango), 0) AS durango,
                COALESCE(SUM(guanajuato), 0) AS guanajuato,
                COALESCE(SUM(guerrero), 0) AS guerrero,
                COALESCE(SUM(hidalgo), 0) AS hidalgo,
                COALESCE(SUM(jalisco), 0) AS jalisco,
                COALESCE(SUM(michoacan_de_ocampo), 0) AS michoacan_de_ocampo,
                COALESCE(SUM(morelos), 0) AS morelos,
                COALESCE(SUM(nayarit), 0) AS nayarit,
                COALESCE(SUM(nuevo_leon), 0) AS nuevo_leon,
                COALESCE(SUM(oaxaca), 0) AS oaxaca,
                COALESCE(SUM(puebla), 0) AS puebla,
                COALESCE(SUM(queretaro_arteaga), 0) AS queretaro_arteaga,
                COALESCE(SUM(quintana_roo), 0) AS quintana_roo,
                COALESCE(SUM(san_luis_potosi), 0) AS san_luis_potosi,
                COALESCE(SUM(sinaloa), 0) AS sinaloa,
                COALESCE(SUM(sonora), 0) AS sonora,
                COALESCE(SUM(estado_de_mexico), 0) AS estado_de_mexico,
                COALESCE(SUM(tabasco), 0) AS tabasco,
                COALESCE(SUM(tamaulipas), 0) AS tamaulipas,
                COALESCE(SUM(tlaxcala), 0) AS tlaxcala,
                COALESCE(SUM(veracruz), 0) AS veracruz,
                COALESCE(SUM(yucatan), 0) AS yucatan,
                COALESCE(SUM(zacatecas), 0) AS zacatecas
            FROM premium_region_data
            WHERE date BETWEEN :startDate AND :endDate
                AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}