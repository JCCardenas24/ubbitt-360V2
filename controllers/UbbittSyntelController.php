<?php

namespace app\controllers;

use yii\rest\Controller;;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\VerbFilter;
use app\models\db\SyntelCallInfo;

class UbbittSyntelController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'last-call' => ['get'],
                'store-calls' => ['post'],
                'update-calls' => ['post'],
            ],
        ];

        return $behaviors;
    }

    // public $modelClass = 'app\models\User';

    public function actionStoreCalls() {
        $data = $this->request->post();
        $calls = json_decode($data['calls'], true, 512, JSON_UNESCAPED_UNICODE);

        foreach ($calls as $index => $call) {
            $syntelCall = new SyntelCallInfo();
            $syntelCall->pkCall = $call['pk_call'];
            $syntelCall->callType = $call['call_type'];
            $syntelCall->callPurpose = $call['call_purpose'];
            $syntelCall->callStart = $call['call_start'];
            $syntelCall->callEnd = $call['call_end'];
            $syntelCall->trackerName = $call['tracker_name'];
            $syntelCall->stepName = $call['step_name'];
            $syntelCall->callpickerNumber = $call['troncal_number'];
            $syntelCall->salesStatus = $call['sales_status'];
            $syntelCall->collectedStatus = $call['collected_status'];
            $syntelCall->amount = $call['amount'];
            $syntelCall->fkLead = $call['fk_lead'];
            $syntelCall->save();
            $errors = $syntelCall->errors;
        }

        return json_encode(['message' => 'calls registered '.count($calls)]);
    }
    
    public function actionLastCall() {
        $last_call =SyntelCallInfo::find()->orderBy(['pk_call'=> SORT_DESC])->one();

        return $last_call != null ? $last_call->pk_call : null;
    }
    
    public function actionUpdateCalls() {
        $data = $this->request->post();
        $lead_id = $data['lead_id'];
        $calls = json_decode($data['calls'], true, 512, JSON_UNESCAPED_UNICODE);

        foreach ($calls as $call) {
            $syntelCall = SyntelCallInfo::findOne(['pk_call' => $call['pk_call']]);
            $syntelCall->callType = $call['call_type'];
            $syntelCall->callPurpose = $call['call_purpose'];
            $syntelCall->callStart = $call['call_start'];
            $syntelCall->callEnd = $call['call_end'];
            $syntelCall->trackerName = $call['tracker_name'];
            $syntelCall->stepName = $call['step_name'];
            $syntelCall->callpickerNumber = $call['troncal_number'];
            $syntelCall->salesStatus = $call['sales_status'];
            $syntelCall->collectedStatus = $call['collected_status'];
            $syntelCall->amount = $call['amount'];
            $syntelCall->fkLead = $call['fk_lead'];
            $syntelCall->save();
        }

        return json_encode(['message' => "Calls updated: ".count($calls)." from lead: ".$lead_id]);
    }

}
