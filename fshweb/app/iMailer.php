<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 23/11/2015
 * Time: 11:40 PM
 */

namespace App;


interface iMailer
{
    public function sendMail($to , $from, $subject, $body);
}