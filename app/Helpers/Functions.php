<?php

namespace App\Helpers;

use App\Mail\MailHelper;
use App\Mail\OTPMailHandler;
use Illuminate\Support\Facades\Mail;

/**
 * 
 *
 * This class contains functions helpers for the entire project
 *
 */

  /**
     * return success response.
     *

    */

 class Functions{
    public static function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public static function generate_random_number(){
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }


    function _format_number($number)
    {
        $a = str_replace(" ", "", $number);
        $b = str_replace("+234", "0", $a);
        $c = str_replace(",", "", $b);

        $d = str_replace("+", "", $c);
        $e = str_replace("*", "", $d);
        $f = str_replace("#", "", $e);
        return '234' . substr($f, 1);
    }

 }