<?php

namespace App\Utils;


use GuzzleHttp\Client;

class Slack {

    // @TODO: add params and make the function dynamic and re-usable
    public static function send()
    {
        $payload['text']       = '[' . date('Y-m-d H:i:s') .  '] 📢 *New Lead ID* added in the <https://docs.google.com/spreadsheets/d/15z09Bphnn6D6fEQSWa5jrlqzkdhbNsr5nrOyCmH2TVo/edit#gid=0|Excel sheet>, please add a merchant ID to this new lead ID.';
        $payload['username']   = 'Khardl New TAP LEAD ID';
        $payload['icon_emoji'] = ':loudspeaker:';
        $payload['channel']    = 'khardl-tap-new-leads';

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $guzzleClient = new Client;

        try {
            $response = $guzzleClient->post('https://hooks.slack.com/services/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', [
                'headers' => $headers,
                'body'    => json_encode($payload),
            ]);
        } catch (\Exception $e) {

        }

        return $response ?? null;
    }
}
