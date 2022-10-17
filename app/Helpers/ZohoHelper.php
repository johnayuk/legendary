<?php

namespace App\Helpers;


class ZohoHelper
{

    public function __construct()
    {
    }


    public static function sendMail($subject, $email, $name="", $body)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zeptomail.com/v1.1/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(
                [
                    "bounce_address" => "none@bounce.info.aladdin.ng",
                    "from" => [
                        "address" => "noreply@info.aladdin.ng",
                        "name" => "Aladdin Digital"
                    ],
                    "to" => [
                        [
                            "email_address" => [
                                "address" =>  $email,
                                "name" =>  $name
                            ]
                        ]
                    ],
                    "subject" => $subject,
                    "htmlbody" => $body
                ]
            ),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey wSsVR61xrxT3Xal8yDKtLu89mglXAFn/EUx4i1uhuH+uS/3G88dplkDOVwD2SPAWQjQ/EGYUpu0pnUoC1jUJ2twln1BUDyiF9mqRe1U4J3x17qnvhDzJXG9fkBaBKYkLwA9umWhoE84m+g==",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }

    public static function sendTemplateMail($template_key, $email, $name = "", $params = [])
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zeptomail.com/v1.1/email/template",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(
                [
                    "mail_template_key" => $template_key,
                    "bounce_address" => "none@bounce.info.aladdin.ng",
                    "from" => [
                        "address" => "noreply@info.aladdin.ng",
                        "name" => "Aladdin Digital"
                    ],
                    "to" => [
                        [
                            "email_address" => [
                                "address" =>  $email,
                                "name" =>  $name
                            ]
                        ]
                    ],
                    "merge_info" => $params
                ]
            ),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Zoho-enczapikey wSsVR61xrxT3Xal8yDKtLu89mglXAFn/EUx4i1uhuH+uS/3G88dplkDOVwD2SPAWQjQ/EGYUpu0pnUoC1jUJ2twln1BUDyiF9mqRe1U4J3x17qnvhDzJXG9fkBaBKYkLwA9umWhoE84m+g==",
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
