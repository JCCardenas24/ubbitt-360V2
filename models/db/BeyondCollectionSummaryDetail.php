<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "beyond_summary_detail".
 *
 */
class BeyondCollectionSummaryDetail extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beyond_collection_summary_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'upload_date', 'delivered_base', 'delivered_base_accepted', 'delivered_base_accepted_percentage', 'delivered_base_rejected', 'delivered_base_rejected_percentage',
                'first_management', 'first_management_percentage', 'first_management_effective_registries', 'first_management_effective_registries_percentage', 'first_management_effective_registries_amount',
                'first_management_on_track_registries', 'first_management_on_track_registries_percentage', 'first_management_out_of_management_registries',
                'first_management_out_of_management_registries_percentage',
                'second_management', 'second_management_percentage', 'second_management_effective_registries', 'second_management_effective_registries_percentage', 'second_management_effective_registries_amount',
                'second_management_on_track_registries', 'second_management_on_track_registries_percentage', 'second_management_out_of_management_registries', 'second_management_out_of_management_registries_percentage',
                'third_management', 'third_management_percentage', 'third_management_effective_registries', 'third_management_effective_registries_percentage', 'third_management_effective_registries_amount', 'third_management_on_track_registries',
                'third_management_on_track_registries_percentage', 'third_management_out_of_management_registries', 'third_management_out_of_management_registries_percentage',
                'total_collected', 'conversion_percentage', 'collected_amount', 'on_track_registries', 'pending_amount',

                'fir_man_det_effective_registries', 'fir_man_det_effective_registries_percentage', 'fir_man_det_effective_registries_payment_promise_scheduled', 'fir_man_det_effective_registries_online_payment', 'fir_man_det_effective_registries_new_policy_accepted',
                'fir_man_det_effective_registries_accepted_direct_debit_payment', 'fir_man_det_effective_registries_deposit_slip_sent',
                'fir_man_det_on_track_registries', 'fir_man_det_on_track_registries_percentage', 'fir_man_det_on_track_registries_call_scheduled', 'fir_man_det_on_track_registries_does_not_answer',
                'fir_man_det_on_track_registries_voice_mail',
                'fir_man_det_out_of_management_registries', 'fir_man_det_out_of_management_registries_percentage', 'fir_man_det_out_of_management_registries_wrong_number', 'fir_man_det_out_of_management_registries_policy_cancelled',
                'fir_man_det_out_of_management_registries_does_not_answer', 'fir_man_det_out_of_management_registries_complaint', 'fir_man_det_out_of_management_registries_not_manageable', 'fir_man_det_out_of_management_registries_lost_registry',

                'sec_man_det_effective_registries', 'sec_man_det_effective_registries_percentage', 'sec_man_det_effective_registries_payment_promise_scheduled', 'sec_man_det_effective_registries_online_payment', 'sec_man_det_effective_registries_new_policy_accepted',
                'sec_man_det_effective_registries_accepted_direct_debit_payment', 'sec_man_det_effective_registries_deposit_slip_sent',
                'sec_man_det_on_track_registries', 'sec_man_det_on_track_registries_percentage', 'sec_man_det_on_track_registries_call_scheduled', 'sec_man_det_on_track_registries_does_not_answer',
                'sec_man_det_on_track_registries_voice_mail',
                'sec_man_det_out_of_management_registries', 'sec_man_det_out_of_management_registries_percentage', 'sec_man_det_out_of_management_registries_wrong_number', 'sec_man_det_out_of_management_registries_policy_cancelled',
                'sec_man_det_out_of_management_registries_does_not_answer', 'sec_man_det_out_of_management_registries_complaint', 'sec_man_det_out_of_management_registries_not_manageable', 'sec_man_det_out_of_management_registries_lost_registry',

                'thir_man_det_effective_registries', 'thir_man_det_effective_registries_percentage', 'thir_man_det_effective_registries_payment_promise_scheduled', 'thir_man_det_effective_registries_online_payment', 'thir_man_det_effective_registries_new_policy_accepted',
                'thir_man_det_effective_registries_accepted_direct_debit_payment', 'thir_man_det_effective_registries_deposit_slip_sent',
                'thir_man_det_on_track_registries', 'thir_man_det_on_track_registries_percentage', 'thir_man_det_on_track_registries_call_scheduled', 'thir_man_det_on_track_registries_does_not_answer',
                'thir_man_det_on_track_registries_voice_mail',
                'thir_man_det_out_of_management_registries', 'thir_man_det_out_of_management_registries_percentage', 'thir_man_det_out_of_management_registries_wrong_number', 'thir_man_det_out_of_management_registries_policy_cancelled',
                'thir_man_det_out_of_management_registries_does_not_answer', 'thir_man_det_out_of_management_registries_complaint', 'thir_man_det_out_of_management_registries_not_manageable', 'thir_man_det_out_of_management_registries_lost_registry',

                'four_man_det_effective_registries', 'four_man_det_effective_registries_percentage', 'four_man_det_effective_registries_payment_promise_scheduled', 'four_man_det_effective_registries_online_payment', 'four_man_det_effective_registries_new_policy_accepted',
                'four_man_det_effective_registries_accepted_direct_debit_payment', 'four_man_det_effective_registries_deposit_slip_sent',
                'four_man_det_on_track_registries', 'four_man_det_on_track_registries_percentage', 'four_man_det_on_track_registries_call_scheduled', 'four_man_det_on_track_registries_does_not_answer',
                'four_man_det_on_track_registries_voice_mail',
                'four_man_det_out_of_management_registries', 'four_man_det_out_of_management_registries_percentage', 'four_man_det_out_of_management_registries_wrong_number', 'four_man_det_out_of_management_registries_policy_cancelled',
                'four_man_det_out_of_management_registries_does_not_answer', 'four_man_det_out_of_management_registries_complaint', 'four_man_det_out_of_management_registries_not_manageable', 'four_man_det_out_of_management_registries_lost_registry',

                'on_track_registries_total', 'collected_total', 'total_pending_sale_amount', 'total_collected_sale_amount',
            ], 'required'],
            [[
                'delivered_base', 'delivered_base_accepted', 'delivered_base_rejected', 'first_management', 'first_management_effective_registries', 'first_management_on_track_registries',
                'first_management_out_of_management_registries', 'second_management', 'second_management_effective_registries', 'second_management_on_track_registries',
                'second_management_out_of_management_registries',
                'third_management', 'third_management_effective_registries', 'third_management_on_track_registries', 'third_management_out_of_management_registries',
                'total_collected', 'on_track_registries',

                'fir_man_det_effective_registries', 'fir_man_det_effective_registries_payment_promise_scheduled', 'fir_man_det_effective_registries_online_payment', 'fir_man_det_effective_registries_new_policy_accepted',
                'fir_man_det_effective_registries_accepted_direct_debit_payment', 'fir_man_det_effective_registries_deposit_slip_sent',
                'fir_man_det_on_track_registries', 'fir_man_det_on_track_registries_call_scheduled', 'fir_man_det_on_track_registries_does_not_answer', 'fir_man_det_on_track_registries_voice_mail',
                'fir_man_det_out_of_management_registries', 'fir_man_det_out_of_management_registries_wrong_number', 'fir_man_det_out_of_management_registries_policy_cancelled', 'fir_man_det_out_of_management_registries_does_not_answer',
                'fir_man_det_out_of_management_registries_complaint', 'fir_man_det_out_of_management_registries_not_manageable', 'fir_man_det_out_of_management_registries_lost_registry',

                'sec_man_det_effective_registries', 'sec_man_det_effective_registries_payment_promise_scheduled', 'sec_man_det_effective_registries_online_payment', 'sec_man_det_effective_registries_new_policy_accepted',
                'sec_man_det_effective_registries_accepted_direct_debit_payment', 'sec_man_det_effective_registries_deposit_slip_sent',
                'sec_man_det_on_track_registries', 'sec_man_det_on_track_registries_call_scheduled', 'sec_man_det_on_track_registries_does_not_answer', 'sec_man_det_on_track_registries_voice_mail',
                'sec_man_det_out_of_management_registries', 'sec_man_det_out_of_management_registries_wrong_number', 'sec_man_det_out_of_management_registries_policy_cancelled', 'sec_man_det_out_of_management_registries_does_not_answer',
                'sec_man_det_out_of_management_registries_complaint', 'sec_man_det_out_of_management_registries_not_manageable', 'sec_man_det_out_of_management_registries_lost_registry',

                'thir_man_det_effective_registries', 'thir_man_det_effective_registries_payment_promise_scheduled', 'thir_man_det_effective_registries_online_payment', 'thir_man_det_effective_registries_new_policy_accepted',
                'thir_man_det_effective_registries_accepted_direct_debit_payment', 'thir_man_det_effective_registries_deposit_slip_sent',
                'thir_man_det_on_track_registries', 'thir_man_det_on_track_registries_call_scheduled', 'thir_man_det_on_track_registries_does_not_answer', 'thir_man_det_on_track_registries_voice_mail',
                'thir_man_det_out_of_management_registries', 'thir_man_det_out_of_management_registries_wrong_number', 'thir_man_det_out_of_management_registries_policy_cancelled', 'thir_man_det_out_of_management_registries_does_not_answer',
                'thir_man_det_out_of_management_registries_complaint', 'thir_man_det_out_of_management_registries_not_manageable', 'thir_man_det_out_of_management_registries_lost_registry',

                'four_man_det_effective_registries', 'four_man_det_effective_registries_payment_promise_scheduled', 'four_man_det_effective_registries_online_payment', 'four_man_det_effective_registries_new_policy_accepted',
                'four_man_det_effective_registries_accepted_direct_debit_payment', 'four_man_det_effective_registries_deposit_slip_sent',
                'four_man_det_on_track_registries', 'four_man_det_on_track_registries_call_scheduled', 'four_man_det_on_track_registries_does_not_answer', 'four_man_det_on_track_registries_voice_mail',
                'four_man_det_out_of_management_registries', 'four_man_det_out_of_management_registries_wrong_number', 'four_man_det_out_of_management_registries_policy_cancelled', 'four_man_det_out_of_management_registries_does_not_answer',
                'four_man_det_out_of_management_registries_complaint', 'four_man_det_out_of_management_registries_not_manageable', 'four_man_det_out_of_management_registries_lost_registry',

                'on_track_registries_total', 'collected_total',
            ], 'integer'],
            [[
                'delivered_base_accepted_percentage', 'delivered_base_rejected_percentage', 'first_management_percentage', 'first_management_effective_registries_percentage',
                'first_management_effective_registries_amount', 'first_management_on_track_registries_percentage', 'first_management_out_of_management_registries_percentage', 'second_management_percentage',
                'second_management_effective_registries_percentage', 'second_management_effective_registries_amount',
                'second_management_on_track_registries_percentage', 'second_management_out_of_management_registries_percentage',
                'third_management_percentage', 'third_management_effective_registries_percentage', 'third_management_effective_registries_amount', 'third_management_on_track_registries_percentage',
                'third_management_out_of_management_registries_percentage',
                'conversion_percentage', 'collected_amount', 'pending_amount',

                'fir_man_det_effective_registries_percentage', 'fir_man_det_on_track_registries_percentage',

                'sec_man_det_effective_registries_percentage', 'sec_man_det_on_track_registries_percentage',

                'thir_man_det_effective_registries_percentage', 'thir_man_det_on_track_registries_percentage',

                'four_man_det_effective_registries_percentage', 'four_man_det_on_track_registries_percentage',

                'total_pending_sale_amount', 'total_collected_sale_amount',
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
            'delivered_base' => 'Base entregada',
            'delivered_base_accepted' => 'Base entregada - Aceptados',
            'delivered_base_accepted_percentage' => 'Base entregada - Aceptados porcentaje',
            'delivered_base_rejected' => 'Base entregada - Rechazados',
            'delivered_base_rejected_percentage' => 'Base entregada - Rechazados porcentaje',
            'first_management' => 'Primera gesti??n',
            'first_management_percentage' => 'Primera gesti??n porcentaje',
            'first_management_effective_registries' => 'Primera gesti??n - Registros efectivos',
            'first_management_effective_registries_percentage' => 'Primera gesti??n - Registros efectivos porcentaje',
            'first_management_effective_registries_amount' => 'Primera gesti??n - Registros efectivos Cantidad pesos',
            'first_management_on_track_registries' => 'Primera gesti??n - Registros en seguimiento',
            'first_management_on_track_registries_percentage' => 'Primera gesti??n - Registros en seguimiento porcentaje',
            'first_management_out_of_management_registries' => 'Primera gesti??n - Registros fuera de gesti??n',
            'first_management_out_of_management_registries_percentage' => 'Primera gesti??n - Registros fuera de gesti??n porcentaje',
            'second_management' => 'Segunda gesti??n',
            'second_management_percentage' => 'Segunda gesti??n porcentaje',
            'second_management_effective_registries' => 'Segunda gesti??n - Registros efectivos',
            'second_management_effective_registries_percentage' => 'Segunda gesti??n - Registros efectivos porcentaje',
            'second_management_effective_registries_amount' => 'Segunda gesti??n - Registros efectivos Cantidad pesos',
            'second_management_on_track_registries' => 'Segunda gesti??n - Registros en seguimiento',
            'second_management_on_track_registries_percentage' => 'Segunda gesti??n - Registros en seguimiento porcentaje',
            'second_management_out_of_management_registries' => 'Segunda gesti??n - Registros fuera de gesti??n',
            'second_management_out_of_management_registries_percentage' => 'Segunda gesti??n - Registros fuera de gesti??n porcentaje',
            'third_management' => 'Tercera gesti??n',
            'third_management_percentage' => 'Tercera gesti??n porcentaje',
            'third_management_effective_registries' => 'Tercera gesti??n - Registros efectivos',
            'third_management_effective_registries_percentage' => 'Tercera gesti??n - Registros efectivos porcentaje',
            'third_management_effective_registries_amount' => 'Tercera gesti??n - Registros efectivos Cantidad pesos',
            'third_management_on_track_registries' => 'Tercera gesti??n - Registros en seguimiento',
            'third_management_on_track_registries_percentage' => 'Tercera gesti??n - Registros en seguimiento porcentaje',
            'third_management_out_of_management_registries' => 'Tercera gesti??n - Registros fuera de gesti??n',
            'third_management_out_of_management_registries_percentage' => 'Tercera gesti??n - Registros fuera de gesti??n porcentaje',
            'total_collected' => 'Total cobrados',
            'conversion_percentage' => '% Conversi??n',
            'collected_amount' => 'Monto cobrado',
            'on_track_registries' => 'Registros en seguimiento',
            'pending_amount' => 'Monto pendiente',

            'fir_man_det_effective_registries' => 'Por gesti??n - Primera Gesti??n - Registros efectivos',
            'fir_man_det_effective_registries_percentage' => 'Por gesti??n - Primera Gesti??n - Registros efectivos porcentaje',
            'fir_man_det_effective_registries_payment_promise_scheduled' => 'Por gesti??n - Primera Gesti??n - Registros efectivos - Agenda promesa de pago',
            'fir_man_det_effective_registries_online_payment' => 'Por gesti??n - Primera Gesti??n - Registros efectivos - Paga en l??nea',
            'fir_man_det_effective_registries_new_policy_accepted' => 'Por gesti??n - Primera Gesti??n - Registros efectivos - Acepta p??liza nueva',
            'fir_man_det_effective_registries_accepted_direct_debit_payment' => 'Por gesti??n - Primera Gesti??n - Registros efectivos - Acepta Pago con 5% por domiciliaci??n',
            'fir_man_det_effective_registries_deposit_slip_sent' => 'Por gesti??n - Primera Gesti??n - Registros efectivos - Se env??a ficha de dep??sito',
            'fir_man_det_on_track_registries' => 'Por gesti??n - Primera Gesti??n - Registros en seguimiento',
            'fir_man_det_on_track_registries_percentage' => 'Por gesti??n - Primera Gesti??n - Registros en seguimiento porcentaje',
            'fir_man_det_on_track_registries_call_scheduled' => 'Por gesti??n - Primera Gesti??n - Registros en seguimiento - Agenda llamada',
            'fir_man_det_on_track_registries_detail_does_not_answer' => 'Por gesti??n - Primera Gesti??n - Registros en seguimiento - No contesta',
            'fir_man_det_on_track_registries_voice_mail' => 'Por gesti??n - Primera Gesti??n - Registros en seguimiento - Buz??n',
            'fir_man_det_out_of_management_registries' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n',
            'fir_man_det_out_of_management_registries_percentage' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n porcentaje',
            'fir_man_det_out_of_management_registries_wrong_number' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - N??mero equivocado',
            'fir_man_det_out_of_management_registries_policy_cancelled' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - Contrato cancelado (P??liza cancelada)',
            'fir_man_det_out_of_management_registries_does_not_answer' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - No contesta',
            'fir_man_det_out_of_management_registries_complaint' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - Queja',
            'fir_man_det_out_of_management_registries_not_manageable' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - No gestionable en portal (ZA)',
            'fir_man_det_out_of_management_registries_lost_registry' => 'Por gesti??n - Primera Gesti??n - Registros fuera de gesti??n - Registro perdido',

            'sec_man_det_effective_registries' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos',
            'sec_man_det_effective_registries_percentage' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos porcentaje',
            'sec_man_det_effective_registries_payment_promise_scheduled' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos - Agenda promesa de pago',
            'sec_man_det_effective_registries_online_payment' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos - Paga en l??nea',
            'sec_man_det_effective_registries_new_policy_accepted' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos - Acepta p??liza nueva',
            'sec_man_det_effective_registries_accepted_direct_debit_payment' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos - Acepta Pago con 5% por domiciliaci??n',
            'sec_man_det_effective_registries_deposit_slip_sent' => 'Por gesti??n - Segunda Gesti??n - Registros efectivos - Se env??a ficha de dep??sito',
            'sec_man_det_on_track_registries' => 'Por gesti??n - Segunda Gesti??n - Registros en seguimiento',
            'sec_man_det_on_track_registries_percentage' => 'Por gesti??n - Segunda Gesti??n - Registros en seguimiento porcentaje',
            'sec_man_det_on_track_registries_call_scheduled' => 'Por gesti??n - Segunda Gesti??n - Registros en seguimiento - Agenda llamada',
            'sec_man_det_on_track_registries_does_not_answer' => 'Por gesti??n - Segunda Gesti??n - Registros en seguimiento - No contesta',
            'sec_man_det_on_track_registries_voice_mail' => 'Por gesti??n - Segunda Gesti??n - Registros en seguimiento - Buz??n',
            'sec_man_det_out_of_management_registries' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n',
            'sec_man_det_out_of_management_registries_percentage' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n porcentaje',
            'sec_man_det_out_of_management_registries_wrong_number' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - N??mero equivocado',
            'sec_man_det_out_of_management_registries_policy_cancelled' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - Contrato cancelado (P??liza cancelada)',
            'sec_man_det_out_of_management_registries_does_not_answer' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - No contesta',
            'sec_man_det_out_of_management_registries_complaint' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - Queja',
            'sec_man_det_out_of_management_registries_not_manageable' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - No gestionable en portal (ZA)',
            'sec_man_det_out_of_management_registries_lost_registry' => 'Por gesti??n - Segunda Gesti??n - Registros fuera de gesti??n - Registro perdido',

            'thir_man_det_effective_registries' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos',
            'thir_man_det_effective_registries_percentage' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos porcentaje',
            'thir_man_det_effective_registries_payment_promise_scheduled' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos - Agenda promesa de pago',
            'thir_man_det_effective_registries_online_payment' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos - Paga en l??nea',
            'thir_man_det_effective_registries_new_policy_accepted' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos - Acepta p??liza nueva',
            'thir_man_det_effective_registries_accepted_direct_debit_payment' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos - Acepta Pago con 5% por domiciliaci??n',
            'thir_man_det_effective_registries_deposit_slip_sent' => 'Por gesti??n - Tercera Gesti??n - Registros efectivos - Se env??a ficha de dep??sito',
            'thir_man_det_on_track_registries' => 'Por gesti??n - Tercera Gesti??n - Registros en seguimiento',
            'thir_man_det_on_track_registries_percentage' => 'Por gesti??n - Tercera Gesti??n - Registros en seguimiento porcentaje',
            'thir_man_det_on_track_registries_call_scheduled' => 'Por gesti??n - Tercera Gesti??n - Registros en seguimiento - Agenda llamada',
            'thir_man_det_on_track_registries_does_not_answer' => 'Por gesti??n - Tercera Gesti??n - Registros en seguimiento - No contesta',
            'thir_man_det_on_track_registries_voice_mail' => 'Por gesti??n - Tercera Gesti??n - Registros en seguimiento - Buz??n',
            'thir_man_det_out_of_management_registries' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n',
            'thir_man_det_out_of_management_registries_percentage' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n porcentaje',
            'thir_man_det_out_of_management_registries_wrong_number' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - N??mero equivocado',
            'thir_man_det_out_of_management_registries_policy_cancelled' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - Contrato cancelado (P??liza cancelada)',
            'thir_man_det_out_of_management_registries_does_not_answer' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - No contesta',
            'thir_man_det_out_of_management_registries_complaint' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - Queja',
            'thir_man_det_out_of_management_registries_not_manageable' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - No gestionable en portal (ZA)',
            'thir_man_det_out_of_management_registries_lost_registry' => 'Por gesti??n - Tercera Gesti??n - Registros fuera de gesti??n - Registro perdido',

            'four_man_det_effective_registries' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos',
            'four_man_det_effective_registries_percentage' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos porcentaje',
            'four_man_det_effective_registries_payment_promise_scheduled' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos - Agenda promesa de pago',
            'four_man_det_effective_registries_online_payment' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos - Paga en l??nea',
            'four_man_det_effective_registries_new_policy_accepted' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos - Acepta p??liza nueva',
            'four_man_det_effective_registries_accepted_direct_debit_payment' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos - Acepta Pago con 5% por domiciliaci??n',
            'four_man_det_effective_registries_deposit_slip_sent' => 'Por gesti??n - Cuarta Gesti??n - Registros efectivos - Se env??a ficha de dep??sito',
            'four_man_det_on_track_registries' => 'Por gesti??n - Cuarta Gesti??n - Registros en seguimiento',
            'four_man_det_on_track_registries_percentage' => 'Por gesti??n - Cuarta Gesti??n - Registros en seguimiento porcentaje',
            'four_man_det_on_track_registries_call_scheduled' => 'Por gesti??n - Cuarta Gesti??n - Registros en seguimiento - Agenda llamada',
            'four_man_det_on_track_registries_does_not_answer' => 'Por gesti??n - Cuarta Gesti??n - Registros en seguimiento - No contesta',
            'four_man_det_on_track_registries_voice_mail' => 'Por gesti??n - Cuarta Gesti??n - Registros en seguimiento - Buz??n',
            'four_man_det_out_of_management_registries' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n',
            'four_man_det_out_of_management_registries_percentage' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n porcentaje',
            'four_man_det_out_of_management_registries_wrong_number' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - N??mero equivocado',
            'four_man_det_out_of_management_registries_policy_cancelled' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - Contrato cancelado (P??liza cancelada)',
            'four_man_det_out_of_management_registries_does_not_answer' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - No contesta',
            'four_man_det_out_of_management_registries_complaint' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - Queja',
            'four_man_det_out_of_management_registries_not_manageable' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - No gestionable en portal (ZA)',
            'four_man_det_out_of_management_registries_lost_registry' => 'Por gesti??n - Cuarta Gesti??n - Registros fuera de gesti??n - Registro perdido',

            'on_track_registries_total' => 'Concentrado - Registros en seguimiento',
            'collected_total' => 'Concentrado - Cobrados',
            'total_pending_sale_amount' => 'Venta pendiente total',
            'total_collected_sale_amount' => 'Venta cobrada total',
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
                    COALESCE(SUM(delivered_base), 0) AS delivered_base,
                    COALESCE(SUM(delivered_base_accepted), 0) AS delivered_base_accepted,
                    COALESCE(CAST(AVG(delivered_base_accepted_percentage) AS DECIMAL(5,2)), 0) AS delivered_base_accepted_percentage,
                    COALESCE(SUM(delivered_base_rejected), 0) AS delivered_base_rejected,
                    COALESCE(CAST(AVG(delivered_base_rejected_percentage) AS DECIMAL(5,2)), 0) AS delivered_base_rejected_percentage,
                    COALESCE(SUM(first_management), 0) AS first_management,
                    COALESCE(CAST(AVG(first_management_percentage) AS DECIMAL(5,2)), 0) AS first_management_percentage,
                    COALESCE(SUM(first_management_effective_registries), 0) AS first_management_effective_registries,
                    COALESCE(CAST(AVG(first_management_effective_registries_percentage) AS DECIMAL(5,2)), 0) AS first_management_effective_registries_percentage,
                    COALESCE(SUM(first_management_effective_registries_amount), 0) AS first_management_effective_registries_amount,
                    COALESCE(SUM(first_management_on_track_registries), 0) AS first_management_on_track_registries,
                    COALESCE(CAST(AVG(first_management_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS first_management_on_track_registries_percentage,
                    COALESCE(SUM(first_management_out_of_management_registries), 0) AS first_management_out_of_management_registries,
                    COALESCE(CAST(AVG(first_management_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS first_management_out_of_management_registries_percentage,
                    COALESCE(SUM(second_management), 0) AS second_management,
                    COALESCE(CAST(AVG(second_management_percentage) AS DECIMAL(5,2)), 0) AS second_management_percentage,
                    COALESCE(SUM(second_management_effective_registries), 0) AS second_management_effective_registries,
                    COALESCE(CAST(AVG(second_management_effective_registries_percentage) AS DECIMAL(5,2)), 0) AS second_management_effective_registries_percentage,
                    COALESCE(SUM(second_management_effective_registries_amount), 0) AS second_management_effective_registries_amount,
                    COALESCE(SUM(second_management_on_track_registries), 0) AS second_management_on_track_registries,
                    COALESCE(CAST(AVG(second_management_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS second_management_on_track_registries_percentage,
                    COALESCE(SUM(second_management_out_of_management_registries), 0) AS second_management_out_of_management_registries,
                    COALESCE(CAST(AVG(second_management_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS second_management_out_of_management_registries_percentage,
                    COALESCE(SUM(third_management), 0) AS third_management,
                    COALESCE(CAST(AVG(third_management_percentage) AS DECIMAL(5,2)), 0) AS third_management_percentage,
                    COALESCE(SUM(third_management_effective_registries), 0) AS third_management_effective_registries,
                    COALESCE(CAST(AVG(third_management_effective_registries_percentage) AS DECIMAL(5,2)), 0) AS third_management_effective_registries_percentage,
                    COALESCE(SUM(third_management_effective_registries_amount), 0) AS third_management_effective_registries_amount,
                    COALESCE(SUM(third_management_on_track_registries), 0) AS third_management_on_track_registries,
                    COALESCE(CAST(AVG(third_management_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS third_management_on_track_registries_percentage,
                    COALESCE(SUM(third_management_out_of_management_registries), 0) AS third_management_out_of_management_registries,
                    COALESCE(CAST(AVG(third_management_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS third_management_out_of_management_registries_percentage,
                    COALESCE(SUM(total_collected), 0) AS total_collected,
                    COALESCE(CAST(AVG(conversion_percentage) AS DECIMAL(5,2)), 0) AS conversion_percentage,
                    COALESCE(SUM(collected_amount), 0) AS collected_amount,
                    COALESCE(SUM(on_track_registries), 0) AS on_track_registries,
                    COALESCE(SUM(pending_amount), 0) AS pending_amount,
                    COALESCE(SUM(fir_man_det_effective_registries), 0) AS fir_man_det_effective_registries,
                    COALESCE(SUM(fir_man_det_effective_registries_percentage), 0) AS fir_man_det_effective_registries_percentage,
                    COALESCE(SUM(fir_man_det_effective_registries_payment_promise_scheduled), 0) AS fir_man_det_effective_registries_payment_promise_scheduled,
                    COALESCE(SUM(fir_man_det_effective_registries_online_payment), 0) AS fir_man_det_effective_registries_online_payment,
                    COALESCE(SUM(fir_man_det_effective_registries_new_policy_accepted), 0) AS fir_man_det_effective_registries_new_policy_accepted,
                    COALESCE(SUM(fir_man_det_effective_registries_accepted_direct_debit_payment), 0) AS fir_man_det_effective_registries_accepted_direct_debit_payment,
                    COALESCE(SUM(fir_man_det_effective_registries_deposit_slip_sent), 0) AS fir_man_det_effective_registries_deposit_slip_sent,
                    COALESCE(SUM(fir_man_det_on_track_registries), 0) AS fir_man_det_on_track_registries,
                    COALESCE(CAST(AVG(fir_man_det_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS fir_man_det_on_track_registries_percentage,
                    COALESCE(SUM(fir_man_det_on_track_registries_call_scheduled), 0) AS fir_man_det_on_track_registries_call_scheduled,
                    COALESCE(SUM(fir_man_det_on_track_registries_does_not_answer), 0) AS fir_man_det_on_track_registries_does_not_answer,
                    COALESCE(SUM(fir_man_det_on_track_registries_voice_mail), 0) AS fir_man_det_on_track_registries_voice_mail,
                    COALESCE(SUM(fir_man_det_out_of_management_registries), 0) AS fir_man_det_out_of_management_registries,
                    COALESCE(CAST(AVG(fir_man_det_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS fir_man_det_out_of_management_registries_percentage,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_wrong_number), 0) AS fir_man_det_out_of_management_registries_wrong_number,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_policy_cancelled), 0) AS fir_man_det_out_of_management_registries_policy_cancelled,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_does_not_answer), 0) AS fir_man_det_out_of_management_registries_does_not_answer,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_complaint), 0) AS fir_man_det_out_of_management_registries_complaint,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_not_manageable), 0) AS fir_man_det_out_of_management_registries_not_manageable,
                    COALESCE(SUM(fir_man_det_out_of_management_registries_lost_registry), 0) AS fir_man_det_out_of_management_registries_lost_registry,
                    COALESCE(SUM(sec_man_det_effective_registries), 0) AS sec_man_det_effective_registries,
                    COALESCE(SUM(sec_man_det_effective_registries_percentage), 0) AS sec_man_det_effective_registries_percentage,
                    COALESCE(SUM(sec_man_det_effective_registries_payment_promise_scheduled), 0) AS sec_man_det_effective_registries_payment_promise_scheduled,
                    COALESCE(SUM(sec_man_det_effective_registries_online_payment), 0) AS sec_man_det_effective_registries_online_payment,
                    COALESCE(SUM(sec_man_det_effective_registries_new_policy_accepted), 0) AS sec_man_det_effective_registries_new_policy_accepted,
                    COALESCE(SUM(sec_man_det_effective_registries_accepted_direct_debit_payment), 0) AS sec_man_det_effective_registries_accepted_direct_debit_payment,
                    COALESCE(SUM(sec_man_det_effective_registries_deposit_slip_sent), 0) AS sec_man_det_effective_registries_deposit_slip_sent,
                    COALESCE(SUM(sec_man_det_on_track_registries), 0) AS sec_man_det_on_track_registries,
                    COALESCE(CAST(AVG(sec_man_det_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS sec_man_det_on_track_registries_percentage,
                    COALESCE(SUM(sec_man_det_on_track_registries_call_scheduled), 0) AS sec_man_det_on_track_registries_call_scheduled,
                    COALESCE(SUM(sec_man_det_on_track_registries_does_not_answer), 0) AS sec_man_det_on_track_registries_does_not_answer,
                    COALESCE(SUM(sec_man_det_on_track_registries_voice_mail), 0) AS sec_man_det_on_track_registries_voice_mail,
                    COALESCE(SUM(sec_man_det_out_of_management_registries), 0) AS sec_man_det_out_of_management_registries,
                    COALESCE(CAST(AVG(sec_man_det_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS sec_man_det_out_of_management_registries_percentage,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_wrong_number), 0) AS sec_man_det_out_of_management_registries_wrong_number,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_policy_cancelled), 0) AS sec_man_det_out_of_management_registries_policy_cancelled,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_does_not_answer), 0) AS sec_man_det_out_of_management_registries_does_not_answer,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_complaint), 0) AS sec_man_det_out_of_management_registries_complaint,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_not_manageable), 0) AS sec_man_det_out_of_management_registries_not_manageable,
                    COALESCE(SUM(sec_man_det_out_of_management_registries_lost_registry), 0) AS sec_man_det_out_of_management_registries_lost_registry,
                    COALESCE(SUM(thir_man_det_effective_registries), 0) AS thir_man_det_effective_registries,
                    COALESCE(SUM(thir_man_det_effective_registries_percentage), 0) AS thir_man_det_effective_registries_percentage,
                    COALESCE(SUM(thir_man_det_effective_registries_payment_promise_scheduled), 0) AS thir_man_det_effective_registries_payment_promise_scheduled,
                    COALESCE(SUM(thir_man_det_effective_registries_online_payment), 0) AS thir_man_det_effective_registries_online_payment,
                    COALESCE(SUM(thir_man_det_effective_registries_new_policy_accepted), 0) AS thir_man_det_effective_registries_new_policy_accepted,
                    COALESCE(SUM(thir_man_det_effective_registries_accepted_direct_debit_payment), 0) AS thir_man_det_effective_registries_accepted_direct_debit_payment,
                    COALESCE(SUM(thir_man_det_effective_registries_deposit_slip_sent), 0) AS thir_man_det_effective_registries_deposit_slip_sent,
                    COALESCE(SUM(thir_man_det_on_track_registries), 0) AS thir_man_det_on_track_registries,
                    COALESCE(CAST(AVG(thir_man_det_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS thir_man_det_on_track_registries_percentage,
                    COALESCE(SUM(thir_man_det_on_track_registries_call_scheduled), 0) AS thir_man_det_on_track_registries_call_scheduled,
                    COALESCE(SUM(thir_man_det_on_track_registries_does_not_answer), 0) AS thir_man_det_on_track_registries_does_not_answer,
                    COALESCE(SUM(thir_man_det_on_track_registries_voice_mail), 0) AS thir_man_det_on_track_registries_voice_mail,
                    COALESCE(SUM(thir_man_det_out_of_management_registries), 0) AS thir_man_det_out_of_management_registries,
                    COALESCE(CAST(AVG(thir_man_det_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS thir_man_det_out_of_management_registries_percentage,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_wrong_number), 0) AS thir_man_det_out_of_management_registries_wrong_number,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_policy_cancelled), 0) AS thir_man_det_out_of_management_registries_policy_cancelled,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_does_not_answer), 0) AS thir_man_det_out_of_management_registries_does_not_answer,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_complaint), 0) AS thir_man_det_out_of_management_registries_complaint,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_not_manageable), 0) AS thir_man_det_out_of_management_registries_not_manageable,
                    COALESCE(SUM(thir_man_det_out_of_management_registries_lost_registry), 0) AS thir_man_det_out_of_management_registries_lost_registry,
                    COALESCE(SUM(four_man_det_effective_registries), 0) AS four_man_det_effective_registries,
                    COALESCE(SUM(four_man_det_effective_registries_percentage), 0) AS four_man_det_effective_registries_percentage,
                    COALESCE(SUM(four_man_det_effective_registries_payment_promise_scheduled), 0) AS four_man_det_effective_registries_payment_promise_scheduled,
                    COALESCE(SUM(four_man_det_effective_registries_online_payment), 0) AS four_man_det_effective_registries_online_payment,
                    COALESCE(SUM(four_man_det_effective_registries_new_policy_accepted), 0) AS four_man_det_effective_registries_new_policy_accepted,
                    COALESCE(SUM(four_man_det_effective_registries_accepted_direct_debit_payment), 0) AS four_man_det_effective_registries_accepted_direct_debit_payment,
                    COALESCE(SUM(four_man_det_effective_registries_deposit_slip_sent), 0) AS four_man_det_effective_registries_deposit_slip_sent,
                    COALESCE(SUM(four_man_det_on_track_registries), 0) AS four_man_det_on_track_registries,
                    COALESCE(CAST(AVG(four_man_det_on_track_registries_percentage) AS DECIMAL(5,2)), 0) AS four_man_det_on_track_registries_percentage,
                    COALESCE(SUM(four_man_det_on_track_registries_call_scheduled), 0) AS four_man_det_on_track_registries_call_scheduled,
                    COALESCE(SUM(four_man_det_on_track_registries_does_not_answer), 0) AS four_man_det_on_track_registries_does_not_answer,
                    COALESCE(SUM(four_man_det_on_track_registries_voice_mail), 0) AS four_man_det_on_track_registries_voice_mail,
                    COALESCE(SUM(four_man_det_out_of_management_registries), 0) AS four_man_det_out_of_management_registries,
                    COALESCE(CAST(AVG(four_man_det_out_of_management_registries_percentage) AS DECIMAL(5,2)), 0) AS four_man_det_out_of_management_registries_percentage,
                    COALESCE(SUM(four_man_det_out_of_management_registries_wrong_number), 0) AS four_man_det_out_of_management_registries_wrong_number,
                    COALESCE(SUM(four_man_det_out_of_management_registries_policy_cancelled), 0) AS four_man_det_out_of_management_registries_policy_cancelled,
                    COALESCE(SUM(four_man_det_out_of_management_registries_does_not_answer), 0) AS four_man_det_out_of_management_registries_does_not_answer,
                    COALESCE(SUM(four_man_det_out_of_management_registries_complaint), 0) AS four_man_det_out_of_management_registries_complaint,
                    COALESCE(SUM(four_man_det_out_of_management_registries_not_manageable), 0) AS four_man_det_out_of_management_registries_not_manageable,
                    COALESCE(SUM(four_man_det_out_of_management_registries_lost_registry), 0) AS four_man_det_out_of_management_registries_lost_registry,
                    COALESCE(SUM(on_track_registries_total), 0) AS on_track_registries_total,
                    COALESCE(SUM(collected_total), 0) AS collected_total,
                    COALESCE(SUM(total_pending_sale_amount), 0) AS total_pending_sale_amount,
                    COALESCE(SUM(total_collected_sale_amount), 0) AS total_collected_sale_amount
                FROM beyond_collection_summary_detail
                WHERE upload_date BETWEEN :startDate AND :endDate', [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->queryOne();
    }
}