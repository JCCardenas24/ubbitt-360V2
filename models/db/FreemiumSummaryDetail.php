<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "freemium_summary_detail".
 *
 */
class FreemiumSummaryDetail extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freemium_summary_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'upload_date', 'nco_total_calls',
                'sale_reason', 'sale_reason_percentage', 'sale_accepted', 'sale_accepted_percentage', 'sale_accepted_sales', 'sale_accepted_sales_percentage', 'sale_accepted_on_track',
                'sale_accepted_on_track_percentage', 'sale_accepted_charged', 'sale_accepted_charged_percentage', 'sale_accepted_not_charged', 'sale_accepted_not_charged_percentage',
                'call_scheduled', 'call_scheduled_percentage', 'call_scheduled_sales', 'call_scheduled_sales_percentage', 'call_scheduled_on_track', 'call_scheduled_on_track_percentage',
                'call_scheduled_charged', 'call_scheduled_charged_percentage', 'call_scheduled_not_charged', 'call_scheduled_not_charged_percentage',
                'payment_promise_scheduled', 'payment_promise_scheduled_percentage', 'payment_promise_scheduled_sales', 'payment_promise_scheduled_sales_percentage', 'payment_promise_scheduled_on_track',
                'payment_promise_scheduled_on_track_percentage', 'payment_promise_scheduled_charged', 'payment_promise_scheduled_charged_percentage', 'payment_promise_scheduled_not_charged',
                'payment_promise_scheduled_not_charged_percentage',
                'deposit_slip_sent', 'deposit_slip_sent_percentage', 'deposit_slip_sent_sales', 'deposit_slip_sent_sales_percentage', 'deposit_slip_sent_on_track', 'deposit_slip_sent_on_track_percentage',
                'deposit_slip_sent_charged', 'deposit_slip_sent_charged_percentage', 'deposit_slip_sent_not_charged', 'deposit_slip_sent_not_charged_percentage',
                'cust_serv_calls', 'cust_serv_calls_percentage', 'cust_serv_calls_ubbitt_assistance', 'cust_serv_calls_ubbitt_assistance_percentage',
                'cust_serv_calls_product_questions', 'cust_serv_calls_product_questions_percentage', 'cust_serv_calls_product_advisory',
                'cust_serv_calls_product_advisory_percentage', 'cust_serv_calls_product_linkage', 'cust_serv_calls_product_linkage_percentage', 'cust_serv_calls_coverage_linkage',
                'cust_serv_calls_coverage_linkage_percentage', 'cust_serv_calls_other_products', 'cust_serv_calls_other_products_percentage',
                'cust_serv_calls_other_products_medical_expenses', 'cust_serv_calls_other_products_medical_expenses_percentage', 'cust_serv_calls_other_products_life',
                'cust_serv_calls_other_products_life_percentage', 'cust_serv_calls_other_products_legalized', 'cust_serv_calls_other_products_legalized_percentage',
                'cust_serv_calls_other_products_platforms', 'cust_serv_calls_other_products_platforms_percentage', 'cust_serv_calls_other_products_residential',
                'cust_serv_calls_other_products_residential_percentage',
                'cust_serv_cust_serv', 'cust_serv_cust_serv_percentage', 'cust_serv_cust_serv_report_advisor_care',
                'cust_serv_cust_serv_report_advisor_care_percentage', 'cust_serv_cust_serv_policy_renewal_review',
                'cust_serv_cust_serv_policy_renewal_review_percentage', 'cust_serv_cust_serv_product_cancellation', 'cust_serv_cust_serv_product_cancellation_percentage',
                'cust_serv_cust_serv_check_expiration_dates', 'cust_serv_cust_serv_check_expiration_dates_percentage',
                'cust_serv_collection_questions', 'cust_serv_collection_questions_percentage', 'cust_serv_collection_questions_payment_track',
                'cust_serv_collection_questions_payment_track_percentage', 'cust_serv_collection_questions_refund', 'cust_serv_collection_questions_refund_percentage',
                'cust_serv_collection_questions_payment_clarification', 'cust_serv_collection_questions_payment_clarification_percentage', 'cust_serv_collection_questions_make_payment',
                'cust_serv_collection_questions_make_payment_percentage',
                'total_sales', 'sales_total_amount', 'conversion_percentage', 'emissions_total', 'collection_percentage', 'total_collections', 'total_sale_issued', 'total_sale_paid',
            ], 'required'],
            [[
                'nco_total_calls',
                'sale_reason', 'sale_accepted', 'sale_accepted_sales', 'sale_accepted_on_track', 'sale_accepted_charged', 'sale_accepted_not_charged',
                'call_scheduled', 'call_scheduled_sales', 'call_scheduled_on_track', 'call_scheduled_charged', 'call_scheduled_not_charged',
                'payment_promise_scheduled', 'payment_promise_scheduled_sales', 'payment_promise_scheduled_on_track', 'payment_promise_scheduled_charged', 'payment_promise_scheduled_not_charged',
                'deposit_slip_sent', 'deposit_slip_sent_sales', 'deposit_slip_sent_on_track', 'deposit_slip_sent_charged', 'deposit_slip_sent_not_charged',
                'cust_serv_calls', 'cust_serv_calls_ubbitt_assistance', 'cust_serv_calls_product_questions', 'cust_serv_calls_product_advisory', 'cust_serv_calls_product_linkage', 'cust_serv_calls_coverage_linkage',
                'cust_serv_calls_other_products', 'cust_serv_calls_other_products_medical_expenses', 'cust_serv_calls_other_products_life', 'cust_serv_calls_other_products_legalized', 'cust_serv_calls_other_products_platforms', 'cust_serv_calls_other_products_residential',
                'cust_serv_cust_serv', 'cust_serv_cust_serv_report_advisor_care', 'cust_serv_cust_serv_policy_renewal_review', 'cust_serv_cust_serv_product_cancellation', 'cust_serv_cust_serv_check_expiration_dates',
                'cust_serv_collection_questions', 'cust_serv_collection_questions_payment_track', 'cust_serv_collection_questions_refund', 'cust_serv_collection_questions_payment_clarification', 'cust_serv_collection_questions_make_payment',
                'total_sales', 'emissions_total', 'total_collections',
            ], 'integer'],
            [[
                'sale_reason_percentage', 'sale_accepted_percentage', 'sale_accepted_sales_percentage', 'sale_accepted_on_track_percentage', 'sale_accepted_charged_percentage', 'sale_accepted_not_charged_percentage',
                'call_scheduled_percentage', 'call_scheduled_sales_percentage', 'call_scheduled_on_track_percentage', 'call_scheduled_charged_percentage', 'call_scheduled_not_charged_percentage',
                'payment_promise_scheduled_percentage', 'payment_promise_scheduled_sales_percentage', 'payment_promise_scheduled_on_track_percentage', 'payment_promise_scheduled_charged_percentage', 'payment_promise_scheduled_not_charged_percentage',
                'deposit_slip_sent_percentage', 'deposit_slip_sent_sales_percentage', 'deposit_slip_sent_on_track_percentage', 'deposit_slip_sent_charged_percentage', 'deposit_slip_sent_not_charged_percentage',
                'cust_serv_calls_percentage', 'cust_serv_calls_ubbitt_assistance_percentage', 'cust_serv_calls_product_questions_percentage', 'cust_serv_calls_product_advisory_percentage', 'cust_serv_calls_product_linkage_percentage', 'cust_serv_calls_coverage_linkage_percentage',
                'cust_serv_calls_other_products_percentage', 'cust_serv_calls_other_products_medical_expenses_percentage', 'cust_serv_calls_other_products_life_percentage', 'cust_serv_calls_other_products_legalized_percentage', 'cust_serv_calls_other_products_platforms_percentage', 'cust_serv_calls_other_products_residential_percentage',
                'cust_serv_cust_serv_percentage', 'cust_serv_cust_serv_report_advisor_care_percentage', 'cust_serv_cust_serv_policy_renewal_review_percentage', 'cust_serv_cust_serv_product_cancellation_percentage', 'cust_serv_cust_serv_check_expiration_dates_percentage',
                'cust_serv_collection_questions_percentage', 'cust_serv_collection_questions_payment_track_percentage', 'cust_serv_collection_questions_refund_percentage', 'cust_serv_collection_questions_payment_clarification_percentage', 'cust_serv_collection_questions_make_payment_percentage',
                'sales_total_amount', 'conversion_percentage', 'collection_percentage', 'total_sale_issued', 'total_sale_paid',
            ], 'double'],
            [['upload_date'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_date' => 'Fecha de carga',
            'nco_total_calls' => 'NCO',
            'sale_reason' => 'Llamadas Motivo de venta',
            'sale_reason_percentage' => 'Porcentaje Motivo de venta',
            'sale_accepted' => 'Acepta venta',
            'sale_accepted_percentage' => 'Acepta venta porcentaje',
            'sale_accepted_sales' => 'Acepta venta - Ventas',
            'sale_accepted_sales_percentage' => 'Acepta venta - Ventas porcentaje',
            'sale_accepted_on_track' => 'Acepta venta - En seguimiento',
            'sale_accepted_on_track_percentage' => 'Acepta venta - En seguimiento porcentaje',
            'sale_accepted_charged' => 'Acepta venta - Ventas - Cobrado',
            'sale_accepted_charged_percentage' => 'Acepta venta - Ventas - Cobrado porcentaje',
            'sale_accepted_not_charged' => 'Acepta venta - Ventas - No Cobrado',
            'sale_accepted_not_charged_percentage' => 'Acepta venta - Ventas - No Cobrado porcentaje',
            'call_scheduled' => 'Agenda llamada',
            'call_scheduled_percentage' => 'Agenda llamada porcentaje',
            'call_scheduled_sales' => 'Agenda llamada - Ventas',
            'call_scheduled_sales_percentage' => 'Agenda llamada - Ventas porcentaje',
            'call_scheduled_on_track' => 'Agenda llamada - En seguimiento',
            'call_scheduled_on_track_percentage' => 'Agenda llamada - En seguimiento porcentaje',
            'call_scheduled_charged' => 'Agenda llamada - Ventas - Cobrado',
            'call_scheduled_charged_percentage' => 'Agenda llamada - Ventas - Cobrado porcentaje',
            'call_scheduled_not_charged' => 'Agenda llamada - Ventas - No Cobrado',
            'call_scheduled_not_charged_percentage' => 'Agenda llamada - Ventas - No Cobrado porcentaje',
            'payment_promise_scheduled' => 'Agenda promesa de pago',
            'payment_promise_scheduled_percentage' => 'Agenda promesa de pago porcentaje',
            'payment_promise_scheduled_sales' => 'Agenda promesa de pago - Ventas',
            'payment_promise_scheduled_sales_percentage' => 'Agenda promesa de pago - Ventas porcentaje',
            'payment_promise_scheduled_on_track' => 'Agenda promesa de pago - En seguimiento',
            'payment_promise_scheduled_on_track_percentage' => 'Agenda promesa de pago - En seguimiento porcentaje',
            'payment_promise_scheduled_charged' => 'Agenda promesa de pago - Ventas - Cobrado',
            'payment_promise_scheduled_charged_percentage' => 'Agenda promesa de pago - Ventas - Cobrado porcentaje',
            'payment_promise_scheduled_not_charged' => 'Agenda promesa de pago - Ventas - No Cobrado',
            'payment_promise_scheduled_not_charged_percentage' => 'Agenda promesa de pago - Ventas - No Cobrado porcentaje',
            'deposit_slip_sent' => 'Envía ficha de depósito',
            'deposit_slip_sent_percentage' => 'Envía ficha de depósito porcentaje',
            'deposit_slip_sent_sales' => 'Envía ficha de depósito - Ventas',
            'deposit_slip_sent_sales_percentage' => 'Envía ficha de depósito - Ventas porcentaje',
            'deposit_slip_sent_on_track' => 'Envía ficha de depósito - En seguimiento',
            'deposit_slip_sent_on_track_percentage' => 'Envía ficha de depósito - En seguimiento porcentaje',
            'deposit_slip_sent_charged' => 'Envía ficha de depósito - Ventas - Cobrado',
            'deposit_slip_sent_charged_percentage' => 'Envía ficha de depósito - Ventas - Cobrado porcentaje',
            'deposit_slip_sent_not_charged' => 'Envía ficha de depósito - Ventas - No Cobrado',
            'deposit_slip_sent_not_charged_percentage' => 'Envía ficha de depósito - Ventas - No Cobrado porcentaje',
            'cust_serv_calls' => 'Atención a clientes / Llamadas de Atención a clientes',
            'cust_serv_calls_percentage' => 'Atención a clientes / Llamadas de Atención a clientes porcentaje',
            'cust_serv_calls_ubbitt_assistance' => 'Asistencia ubbitt',
            'cust_serv_calls_ubbitt_assistance_percentage' => 'Asistencia ubbitt porcentaje',
            'cust_serv_calls_product_questions' => 'Asistencia ubbitt - Dudas de producto',
            'cust_serv_calls_product_questions_percentage' => 'Asistencia ubbitt - Dudas de producto porcentaje',
            'cust_serv_calls_product_advisory' => 'Asistencia ubbitt - Asesorías de producto',
            'cust_serv_calls_product_advisory_percentage' => 'Asistencia ubbitt - Asesorías de producto porcentaje',
            'cust_serv_calls_product_linkage' => 'Asistencia ubbitt - Enlace de producto',
            'cust_serv_calls_product_linkage_percentage' => 'Asistencia ubbitt - Enlace de producto porcentaje',
            'cust_serv_calls_coverage_linkage' => 'Asistencia ubbitt - Enlace de coberturas',
            'cust_serv_calls_coverage_linkage_percentage' => 'Asistencia ubbitt - Enlace de coberturas porcentaje',
            'cust_serv_calls_other_products' => 'Otros productos',
            'cust_serv_calls_other_products_percentage' => 'Otros productos porcentaje',
            'cust_serv_calls_other_products_medical_expenses' => 'Otros productos - Gastos médicos',
            'cust_serv_calls_other_products_medical_expenses_percentage' => 'Otros productos - Gastos médicos porcentaje',
            'cust_serv_calls_other_products_life' => 'Otros productos - Vida',
            'cust_serv_calls_other_products_life_percentage' => 'Otros productos - Vida porcentaje',
            'cust_serv_calls_other_products_legalized' => 'Otros productos - Legalizados',
            'cust_serv_calls_other_products_legalized_percentage' => 'Otros productos - Legalizados porcentaje',
            'cust_serv_calls_other_products_platforms' => 'Otros productos - Plataformas',
            'cust_serv_calls_other_products_platforms_percentage' => 'Otros productos - Plataformas porcentaje',
            'cust_serv_calls_other_products_residential' => 'Otros productos - Residenciales',
            'cust_serv_calls_other_products_residential_percentage' => 'Otros productos - Residenciales porcentaje',
            'cust_serv_cust_serv' => 'Atención a clientes / Llamadas de Atención a clientes - Atención a clientes',
            'cust_serv_cust_serv_percentage' => 'Atención a clientes / Llamadas de Atención a clientes - Atención a clientes porcentaje',
            'cust_serv_cust_serv_report_advisor_care' => 'Atención a clientes - Reportar atención de asesor',
            'cust_serv_cust_serv_report_advisor_care_percentage' => 'Atención a clientes - Reportar atención de asesor porcentaje',
            'cust_serv_cust_serv_policy_renewal_review' => 'Atención a clientes - Revisión renovación póliza',
            'cust_serv_cust_serv_policy_renewal_review_percentage' => 'Atención a clientes - Revisión renovación póliza porcentaje',
            'cust_serv_cust_serv_product_cancellation' => 'Atención a clientes - Cancelación de producto',
            'cust_serv_cust_serv_product_cancellation_percentage' => 'Atención a clientes - Cancelación de producto porcentaje',
            'cust_serv_cust_serv_check_expiration_dates' => 'Atención a clientes - Checar fechas de vigencia',
            'cust_serv_cust_serv_check_expiration_dates_percentage' => 'Atención a clientes - Checar fechas de vigencia porcentaje',
            'cust_serv_collection_questions' => 'Dudas de cobranza',
            'cust_serv_collection_questions_percentage' => 'Dudas de cobranza porcentaje',
            'cust_serv_collection_questions_payment_track' => 'Dudas de cobranza - Seguimiento de pago',
            'cust_serv_collection_questions_payment_track_percentage' => 'Dudas de cobranza - Seguimiento de pago porcentaje',
            'cust_serv_collection_questions_refund' => 'Dudas de cobranza - Reembolsos',
            'cust_serv_collection_questions_refund_percentage' => 'Dudas de cobranza - Reembolsos porcentaje',
            'cust_serv_collection_questions_payment_clarification' => 'Dudas de cobranza - Aclaración de pago',
            'cust_serv_collection_questions_payment_clarification_percentage' => 'Dudas de cobranza - Aclaración de pago porcentaje',
            'cust_serv_collection_questions_make_payment' => 'Dudas de cobranza - Realizar pago',
            'cust_serv_collection_questions_make_payment_percentage' => 'Dudas de cobranza - Realizar pago porcentaje',
            'total_sales' => 'Total ventas',
            'sales_total_amount' => 'Monto total vendido',
            'conversion_percentage' => '% Conversión',
            'emissions_total' => 'Total de emisiones /EMISIONES',
            'collection_percentage' => ' porcentaje',
            'total_collections' => '% Cobranza',
            'total_sale_issued' => 'Venta total emitida',
            'total_sale_paid' => 'Venta total Pagada',

        ];
    }

    public function getUploadDate()
    {
        return $this->upload_date;
    }

    public function setUploadDate($uploadDate)
    {
        $this->upload_date = $uploadDate;
    }

    public function findByDate()
    {
        return self::find()
            ->where(['upload_date' => $this->upload_date])
            ->one();
    }

    public function findKpisReport($startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
                SELECT
                    COALESCE(SUM(nco_total_calls), 0) AS nco_total_calls,
                    COALESCE(SUM(sale_reason), 0) AS sale_reason,
                    COALESCE(CAST(AVG(sale_reason_percentage) AS DECIMAL(5,2)), 0) AS sale_reason_percentage,
                    COALESCE(SUM(sale_accepted), 0) AS sale_accepted,
                    COALESCE(CAST(AVG(sale_accepted_percentage) AS DECIMAL(5,2)), 0) AS sale_accepted_percentage,
                    COALESCE(SUM(sale_accepted_sales), 0) AS sale_accepted_sales,
                    COALESCE(CAST(AVG(sale_accepted_sales_percentage) AS DECIMAL(5,2)), 0) AS sale_accepted_sales_percentage,
                    COALESCE(SUM(sale_accepted_on_track), 0) AS sale_accepted_on_track,
                    COALESCE(CAST(AVG(sale_accepted_on_track_percentage) AS DECIMAL(5,2)), 0) AS sale_accepted_on_track_percentage,
                    COALESCE(SUM(sale_accepted_charged), 0) AS sale_accepted_charged,
                    COALESCE(CAST(AVG(sale_accepted_charged_percentage) AS DECIMAL(5,2)), 0) AS sale_accepted_charged_percentage,
                    COALESCE(SUM(sale_accepted_not_charged), 0) AS sale_accepted_not_charged,
                    COALESCE(CAST(AVG(sale_accepted_not_charged_percentage) AS DECIMAL(5,2)), 0) AS sale_accepted_not_charged_percentage,
                    COALESCE(SUM(call_scheduled), 0) AS call_scheduled,
                    COALESCE(CAST(AVG(call_scheduled_percentage) AS DECIMAL(5,2)), 0) AS call_scheduled_percentage,
                    COALESCE(SUM(call_scheduled_sales), 0) AS call_scheduled_sales,
                    COALESCE(CAST(AVG(call_scheduled_sales_percentage) AS DECIMAL(5,2)), 0) AS call_scheduled_sales_percentage,
                    COALESCE(SUM(call_scheduled_on_track), 0) AS call_scheduled_on_track,
                    COALESCE(CAST(AVG(call_scheduled_on_track_percentage) AS DECIMAL(5,2)), 0) AS call_scheduled_on_track_percentage,
                    COALESCE(SUM(call_scheduled_charged), 0) AS call_scheduled_charged,
                    COALESCE(CAST(AVG(call_scheduled_charged_percentage) AS DECIMAL(5,2)), 0) AS call_scheduled_charged_percentage,
                    COALESCE(SUM(call_scheduled_not_charged), 0) AS call_scheduled_not_charged,
                    COALESCE(CAST(AVG(call_scheduled_not_charged_percentage) AS DECIMAL(5,2)), 0) AS call_scheduled_not_charged_percentage,
                    COALESCE(SUM(payment_promise_scheduled), 0) AS payment_promise_scheduled,
                    COALESCE(CAST(AVG(payment_promise_scheduled_percentage) AS DECIMAL(5,2)), 0) AS payment_promise_scheduled_percentage,
                    COALESCE(SUM(payment_promise_scheduled_sales), 0) AS payment_promise_scheduled_sales,
                    COALESCE(CAST(AVG(payment_promise_scheduled_sales_percentage) AS DECIMAL(5,2)), 0) AS payment_promise_scheduled_sales_percentage,
                    COALESCE(SUM(payment_promise_scheduled_on_track), 0) AS payment_promise_scheduled_on_track,
                    COALESCE(CAST(AVG(payment_promise_scheduled_on_track_percentage) AS DECIMAL(5,2)), 0) AS payment_promise_scheduled_on_track_percentage,
                    COALESCE(SUM(payment_promise_scheduled_charged), 0) AS payment_promise_scheduled_charged,
                    COALESCE(CAST(AVG(payment_promise_scheduled_charged_percentage) AS DECIMAL(5,2)), 0) AS payment_promise_scheduled_charged_percentage,
                    COALESCE(SUM(payment_promise_scheduled_not_charged), 0) AS payment_promise_scheduled_not_charged,
                    COALESCE(CAST(AVG(payment_promise_scheduled_not_charged_percentage) AS DECIMAL(5,2)), 0) AS payment_promise_scheduled_not_charged_percentage,
                    COALESCE(SUM(deposit_slip_sent), 0) AS deposit_slip_sent,
                    COALESCE(CAST(AVG(deposit_slip_sent_percentage) AS DECIMAL(5,2)), 0) AS deposit_slip_sent_percentage,
                    COALESCE(SUM(deposit_slip_sent_sales), 0) AS deposit_slip_sent_sales,
                    COALESCE(CAST(AVG(deposit_slip_sent_sales_percentage) AS DECIMAL(5,2)), 0) AS deposit_slip_sent_sales_percentage,
                    COALESCE(SUM(deposit_slip_sent_on_track), 0) AS deposit_slip_sent_on_track,
                    COALESCE(CAST(AVG(deposit_slip_sent_on_track_percentage) AS DECIMAL(5,2)), 0) AS deposit_slip_sent_on_track_percentage,
                    COALESCE(SUM(deposit_slip_sent_charged), 0) AS deposit_slip_sent_charged,
                    COALESCE(CAST(AVG(deposit_slip_sent_charged_percentage) AS DECIMAL(5,2)), 0) AS deposit_slip_sent_charged_percentage,
                    COALESCE(SUM(deposit_slip_sent_not_charged), 0) AS deposit_slip_sent_not_charged,
                    COALESCE(CAST(AVG(deposit_slip_sent_not_charged_percentage) AS DECIMAL(5,2)), 0) AS deposit_slip_sent_not_charged_percentage,
                    COALESCE(SUM(cust_serv_calls), 0) AS cust_serv_calls,
                    COALESCE(CAST(AVG(cust_serv_calls_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_percentage,
                    COALESCE(SUM(cust_serv_calls_ubbitt_assistance), 0) AS cust_serv_calls_ubbitt_assistance,
                    COALESCE(CAST(AVG(cust_serv_calls_ubbitt_assistance_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_ubbitt_assistance_percentage,
                    COALESCE(SUM(cust_serv_calls_product_questions), 0) AS cust_serv_calls_product_questions,
                    COALESCE(CAST(AVG(cust_serv_calls_product_questions_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_product_questions_percentage,
                    COALESCE(SUM(cust_serv_calls_product_advisory), 0) AS cust_serv_calls_product_advisory,
                    COALESCE(CAST(AVG(cust_serv_calls_product_advisory_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_product_advisory_percentage,
                    COALESCE(SUM(cust_serv_calls_product_linkage), 0) AS cust_serv_calls_product_linkage,
                    COALESCE(CAST(AVG(cust_serv_calls_product_linkage_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_product_linkage_percentage,
                    COALESCE(SUM(cust_serv_calls_coverage_linkage), 0) AS cust_serv_calls_coverage_linkage,
                    COALESCE(CAST(AVG(cust_serv_calls_coverage_linkage_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_coverage_linkage_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products), 0) AS cust_serv_calls_other_products,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products_medical_expenses), 0) AS cust_serv_calls_other_products_medical_expenses,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_medical_expenses_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_medical_expenses_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products_life), 0) AS cust_serv_calls_other_products_life,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_life_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_life_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products_legalized), 0) AS cust_serv_calls_other_products_legalized,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_legalized_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_legalized_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products_platforms), 0) AS cust_serv_calls_other_products_platforms,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_platforms_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_platforms_percentage,
                    COALESCE(SUM(cust_serv_calls_other_products_residential), 0) AS cust_serv_calls_other_products_residential,
                    COALESCE(CAST(AVG(cust_serv_calls_other_products_residential_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_calls_other_products_residential_percentage,
                    COALESCE(SUM(cust_serv_cust_serv), 0) AS cust_serv_cust_serv,
                    COALESCE(CAST(AVG(cust_serv_cust_serv_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_cust_serv_percentage,
                    COALESCE(SUM(cust_serv_cust_serv_report_advisor_care), 0) AS cust_serv_cust_serv_report_advisor_care,
                    COALESCE(CAST(AVG(cust_serv_cust_serv_report_advisor_care_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_cust_serv_report_advisor_care_percentage,
                    COALESCE(SUM(cust_serv_cust_serv_policy_renewal_review), 0) AS cust_serv_cust_serv_policy_renewal_review,
                    COALESCE(CAST(AVG(cust_serv_cust_serv_policy_renewal_review_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_cust_serv_policy_renewal_review_percentage,
                    COALESCE(SUM(cust_serv_cust_serv_product_cancellation), 0) AS cust_serv_cust_serv_product_cancellation,
                    COALESCE(CAST(AVG(cust_serv_cust_serv_product_cancellation_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_cust_serv_product_cancellation_percentage,
                    COALESCE(SUM(cust_serv_cust_serv_check_expiration_dates), 0) AS cust_serv_cust_serv_check_expiration_dates,
                    COALESCE(CAST(AVG(cust_serv_cust_serv_check_expiration_dates_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_cust_serv_check_expiration_dates_percentage,
                    COALESCE(SUM(cust_serv_collection_questions), 0) AS cust_serv_collection_questions,
                    COALESCE(CAST(AVG(cust_serv_collection_questions_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_collection_questions_percentage,
                    COALESCE(SUM(cust_serv_collection_questions_payment_track), 0) AS cust_serv_collection_questions_payment_track,
                    COALESCE(CAST(AVG(cust_serv_collection_questions_payment_track_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_collection_questions_payment_track_percentage,
                    COALESCE(SUM(cust_serv_collection_questions_refund), 0) AS cust_serv_collection_questions_refund,
                    COALESCE(CAST(AVG(cust_serv_collection_questions_refund_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_collection_questions_refund_percentage,
                    COALESCE(SUM(cust_serv_collection_questions_payment_clarification), 0) AS cust_serv_collection_questions_payment_clarification,
                    COALESCE(CAST(AVG(cust_serv_collection_questions_payment_clarification_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_collection_questions_payment_clarification_percentage,
                    COALESCE(SUM(cust_serv_collection_questions_make_payment), 0) AS cust_serv_collection_questions_make_payment,
                    COALESCE(CAST(AVG(cust_serv_collection_questions_make_payment_percentage) AS DECIMAL(5,2)), 0) AS cust_serv_collection_questions_make_payment_percentage,
                    COALESCE(SUM(total_sales), 0) AS total_sales,
                    COALESCE(SUM(sales_total_amount), 0) AS sales_total_amount,
                    COALESCE(CAST(AVG(conversion_percentage) AS DECIMAL(5,2)), 0) AS conversion_percentage,
                    COALESCE(SUM(emissions_total), 0) AS emissions_total,
                    COALESCE(CAST(AVG(collection_percentage) AS DECIMAL(5,2)), 0) AS collection_percentage,
                    COALESCE(SUM(total_collections), 0) AS total_collections,
                    COALESCE(SUM(total_sale_issued), 0) AS total_sale_issued,
                    COALESCE(SUM(total_sale_paid), 0) AS total_sale_paid
                FROM freemium_summary_detail
                WHERE upload_date BETWEEN :startDate AND :endDate', [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->queryOne();
    }
}