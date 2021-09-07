<?php

namespace app\models;

use Yii;

class AudioDownload
{
    /**
     * @method CURL Execute
     * @author Ro <jesus.gonzalez@aesir.com.mx>
     * @access public
     * @since v0.2
     * @return
     */
    static function callpickerGetRecord($record_key = NULL, $filename = NULL)
    {
        $file = Yii::getAlias('@webroot') . "/assets/audio/{$filename}.mp3";
        if (!file_exists($file)) :
            if ($record_key) :
                $endpoint = "https://api.callpicker.com/oauth/token";

                $post_json = [
                    'grant_type' => 'client_credentials',
                    'scope' => 'call_details',
                    'client_id' => 'CP.CU.63741.6dab6',
                    'client_secret' => 'f7fcac4f7bad6e244158f4b53bb50f0b'
                ];

                $ch = @curl_init();
                @curl_setopt($ch, CURLOPT_POST, true);
                @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
                @curl_setopt($ch, CURLOPT_URL, $endpoint);
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = @curl_exec($ch);
                @curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_error($ch);
                @curl_close($ch);
                $response = json_decode($response);

                $token = $response->access_token;

                $endpoint = "https://api.callpicker.com/call_details/getRecord";

                $post_json = array(
                    'token' => $token,
                    'record_key' => $record_key
                );

                $ch = @curl_init();
                @curl_setopt($ch, CURLOPT_POST, true);
                @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
                @curl_setopt($ch, CURLOPT_URL, $endpoint);
                @curl_setopt($ch, CURLOPT_HTTPHEADER, []);
                @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = @curl_exec($ch);
                @curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_error($ch);
                @curl_close($ch);

                if (!strpos($response, 'error')) file_put_contents($file, $response);
            endif;
        else :
            Yii::info('Record already exists: Skipping....', __METHOD__);
        endif;
    }

    /**
     * @method Descarga un audio por medio de URL
     * @access public
     * @since v0.3
     * @param string $url
     * @param string $filename
     */
    static function callpickerGetRecordAudioUrl($url = NULL, $filename = NULL)
    {
        $file = Yii::getAlias('@webroot') . "/assets/audio/{$filename}.mp3";
        if (!file_exists($file)) {
            if ($url && !empty($url)) {
                file_put_contents($file, file_get_contents($url));
            }
        } else {
            Yii::info('Record already exists: Skipping....', __METHOD__);
        }
    }
}