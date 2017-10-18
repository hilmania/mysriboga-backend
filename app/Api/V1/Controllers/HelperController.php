<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Mail;
use DB;

use App\Http\Controllers\Controller;


class HelperController extends Controller
{
    public function sendMail($email, $tipe)
    {
      $user = User::where('email', $email)->first();
      // $token = md5(90*13+$user->id);
      $token = str_random(6);
      $user->remember_token = $token;
      $user->save();

      if($tipe=="konfirmasi"){
        $emailTemplate="email.mail-konfirmasi";
        $subject="Konfirmasi Registrasi MySriboga";
      }elseif($tipe=="reset-password"){
        $emailTemplate="email.reset";
        $subject="Reset password MySriboga";
      }

      Mail::send($emailTemplate, ['email' => $email, 'token' => $token], function ($message) use ($email, $subject)
      {
          $message->from('mysriboga.info@gmail.com', 'Admin MySriboga');
          $message->subject($subject);
          $message->to($email);
      });
    }
}