<h1> HI {{ $name }} please reset your password ! </h1>

<p>we received a request to change your password: 
if you are not initiator of this request, please let us know for the security of your account .
<br>if you are the initiator click to link below to reset your password.<br>
<a href="{{ route('app_changepassword', ['token' => $activation_token]) }}" target="_blank">reset password </a>

</p>

<p>
    Myapp security team.
</p>
