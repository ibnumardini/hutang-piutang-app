<?php

class Whatsapp extends Notification
{
    private $key;

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function send()
    {
        $url = 'http://116.203.191.58/api/send_message';
        $data = array(
            "phone_no" => $this->destination,
            "key" => $this->key,
            "message" => $this->message,
            "skip_link" => true,
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res);
    }
}
