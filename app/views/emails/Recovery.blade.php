<p>Hi, {{ $email }}</p>

<p>Please follow the link to reset your password {{ url('account/recover/resetpass/email/'.$email) }}</p>