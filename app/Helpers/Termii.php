<?php
/**
 * Aladdin Digital Bank
 *
 * Aladdin is the World's first digital open bank, seamlessly combining banking and commerce.
 *
 * @category Helpers
 * @author  Aladdin Developer Team
 * @copyright Copyright (c) 2021. All right reserved
 * @version 1.1.0
 */

namespace App\Helpers;


/**
 * OTP Generator class
 *
 * This class contains functions to generate one time password
 *
 */

class Termii
{
    private $key, $url;
    public function __construct()
    {
        # code...
        $this->key = "TL24TrfMYUb6iQUjltgU2KsKKr5LLKrw20EqRelLONeHp5DoO31kWNvMfDyPlv";
        $this->url = "https://termii.com/api/sms/send";
    }
    // sends message to one user at a time
    public function send_sms_one($to,$message)
    {
        $format_no = new Functions;
        $number = $format_no->_format_number($to);

        $curl = curl_init();
        $data = array(
            "to" => "$number",
            "from" => "LandsAuto",
            "sms" => "$message",
            "type" => "plain",
            "channel" => "generic",
            "api_key" => "$this->key"
        );

        $post_data = json_encode($data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    //send sms otp
    public function send_otp($to, $channel){
        $format_no = new Functions;
        $number = $format_no->_format_number($to);

        //channel =string dnd, generic or whatsapp
        $curl = curl_init();
        $data = array( "api_key" => "$this->key",
                    "message_type" => "NUMERIC",
                    "to" => $number,
                    "from" => "LandsAuto",
                    "channel" => $channel,
                    "pin_attempts" => 5,
                    "pin_time_to_live" =>  5,
                    "pin_length" => 6,
                    "pin_placeholder" => "< 123456 >",
                    "message_text" => "Kindly use this code to complete your authentication < 123456 >",
                    "pin_type" => "NUMERIC");

        $post_data = json_encode($data);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ng.termii.com/api/sms/otp/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }
    // voice otp
    public function send_voice_otp($to){
        $curl = curl_init();

        $format_no = new Functions;
        $number = $format_no->_format_number($to);

        $data = array( 
        "api_key" => "$this->key",
        "phone_number" => $number,
        "pin_attempts" => 5,
        "pin_time_to_live" =>  5,
        "pin_length" => 6);

        $post_data = json_encode($data);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ng.termii.com/api/sms/otp/send/voice',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$post_data,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    //voice call otp
    public function send_voice_call($to, $code){
        $curl = curl_init();

        $format_no = new Functions;
        $number = $format_no->_format_number($to);

        $data = array( 
        "api_key" => "$this->key",
        "phone_number" => $number,
        "code" => $code
       );
       $post_data = json_encode($data);

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ng.termii.com/api/sms/otp/send/voice',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => $code,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>$post_data,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    //verify_otp
    public function verify_otp($pin, $pin_id){
        $curl = curl_init();
        $data = array ( "api_key" => "$this->key",
                    "pin_id" => $pin_id,
                    "pin" => $pin,
                    );

        $post_data = json_encode($data);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ng.termii.com/api/sms/otp/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}