<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 23/11/2015
 * Time: 11:41 PM
 */

namespace App;

use Mail;

class EmailMailer implements iMailer
{

    public function sendMail($to, $from, $subject, $view, $viewData)
    {

        Mail::send($view, ['viewdata' => $viewData], function($message) use($viewData, $to, $from, $subject)
        {
            $message->from($from);
            $message->to($to);
            $message->subject($subject);
        });
    }

    public function sendMailRaw($to, $from, $subject, $body)
    {
        Mail::raw($body, function($message) use($to, $from, $subject)
        {
            $message->from($from);
            $message->to($to);
            $message->subject($subject);
        });
    }
}