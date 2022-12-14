<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

   protected $request;

   function __construct(Request $request){
      $this->request = $request;
   }


   public function logout(){
        Auth::logout();
        return redirect()->route('login');
   }
// étape1 on vérifie si l'email existe vidéo11
   public function existEmail(){
      $email = $this->request->input('email');

      $user = User::where('email', $email)
                  ->first();

      $response = "";

      ($user) ? $response = "exist" : $response = "not exist";

      return response()-json([
         'response' => $response
      ]);

   }

      public function activationcode($token){
         $user = User::where('activation_token', $token)->first();

         if(!$user){
            return redirect()->route('login')->with('danger', 'this token doesn\'t match any user.');
         }

         if($this->request->isMethod('post')){
            
            $code = $user->activation_code;
            $activation_code = $this->request->input('activation-code');

             if($activation_code != $code){
               return back()->with([
                  'danger' => 'this activation code is invalid !',
                  'activation_code' => $activation_code

               ]);
             }else{
               DB::table('users')
                  ->where('id', $user->id)
                  ->update([

                     'is_verified' => 1,
                     'activation_code' => '',
                     'activation_token' => '',
                     'email_verified_at' => new \DateTimeImmutable,
                     'updated_at' => new \DateTimeImmutable
                  ]);

                  return redirect()->route('login')->with('success', 'your e-mail address has been verified');
             }
         }
         return view('auth.activation_code', [
            'token' => $token
         ]);
      }

      /*
         vérifier si l'utilisateur à déja activer son compte ou pas avant d'etre authentifier
      */
      public function userChecker(){
         $activation_token = Auth::user()->activation_token;
         $is_verified = Auth::user()->is_verified;

         if($is_verified != 1){
            Auth::logout();
            return redirect()->route('app_activation_code', ['token' => $activation_token])
                              ->with('warning', 'your account is not activate yet please check yor mail box 
                              and activate your account or resend de confirmation message');
         }else{
            return redirect()->route('app_dashboard');
         }

      }

      public function resendActivationCode($token){
         $user = User::where('activation_token', $token)->first();
         $email = $user->email;
         $name = $user->name;
         $activation_token = $user->activation_token;
         $activation_code = $user->activation_code;

         
        $emailSend = new EmailService;
        $subject = "Activate your account";
        $emailSend->sendEmail($subject, $email, $name, true, $activation_code, $activation_token);

        return redirect()->route('app_activation_code',
         ['token'=>$token])
         ->with('success', 'you have just resend the new activation code ');

      }

      public function activationAccountLink($token){
         $user = User::where('activation_token', $token)->first();

         if(!$user){
            return redirect()->route('login')->with('danger', 'this token doesn\'t match any user.');
         }

         DB::table('users')
            ->where('id', $user->id)
            ->update([

               'is_verified' => 1,
               'activation_code' => '',
               'activation_token' => '',
               'email_verified_at' => new \DateTimeImmutable,
               'updated_at' => new \DateTimeImmutable
            ]);

         return redirect()->route('login')->with('success', 'your e-mail address has been verified');
      }

      public function ActivationAccountChangeEmail($token){

         $user = User::where('activation_token', $token)->first();

          if($this->request->isMethod('post')){

            $new_email = $this->request->input('new-email');
            $user_existe = User::where('email', $new_email)->first();
            
            if($user_existe){

               return back()->with([
                  'danger' => 'this address email is already used please change another email address !',
                  'new_email' => $new_email

               ]);

            }else{
               DB::table('users')
                  ->where('id', $user->id)
                  ->update([
                     'email' => $new_email,
                     'updated_at' => new \DateTimeImmutable
                  ]);

                  $activation_code = $user->activation_code;
                  $activation_token = $user->activation_token;
                  $name = $user->name;

                  $emailSend = new EmailService;
                  $subject = "Activate your account";               
                  $emailSend->sendEmail($subject, $new_email, $name, true, $activation_code, $activation_token);

                  return redirect()->route('app_activation_code',
                           ['token'=>$token])
                           ->with('success', 'you have just resend the new activation code ');
         
            }

         }else{
               return view('auth.activation_account_change_email', [
               'token' => $token
            ]);
         }
         
      }

      public function forgotpassword(){
         //si la requete est de type post
         if($this->request->isMethod('post')){
            $email = $this->request->input('email-send');
            $user = DB::table('users')->where('email', $email)->first();
            $message = null;

            if($user){
               $full_name = $user->name;
               // on va générer un token pour la réinitialisation du mot de passe de l'utilisateur
               $activation_token = md5(uniqid()) . $email . sha1($email);

               $emailrestpwd = new EmailService;
               $subject = "Reset your password";
               $emailrestpwd->resetPassword($subject, $email, $full_name, true, $activation_token);
               
               DB::table('users')
                     ->where('email', $email)
                     ->update(['activation_token' => $activation_token]);

               $message = 'we have just send the request to reset your password, please check your mail-box';
               return back()->withErrors(['email-success' => $message])
                              ->with('old_email', $email)
                              ->with('success', $message);

            }else{

               $message = 'the email enterred does not exist';
               return back()->withErrors(['email-error' => $message])
                              ->with('old_email', $email)
                              ->with('danger', $message);
            }
         }
         return view('auth.forgot_password');
      }

      public function changePassword($token){
         return view('auth.change_password', [
            'activation_token' => $token
         ]);
      }
   
}
