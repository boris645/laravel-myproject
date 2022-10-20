<h1> HI {{ $name }} please confirm yor email ! </h1>

<p>Please activate your account by copying and pasting your activation code : 

<br>Activation code : {{ $activation_code }}.<br>

OR by clicking the following link : <br>
<a href="{{ route('app_activation_account_link', ['token' => $activation_token]) }}" target="_blank">Confirm your account </a>

</p>

<p>
    Myapp team 
</p>
