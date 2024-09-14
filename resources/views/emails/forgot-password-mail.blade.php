<h3>Reset Password</h3>

<p> Use the otp code below to reset your password!</p>
<strong>{{ $otp_code }}</strong>
<p>OTP Code will expire in {{ $otp_expires_at->diffForHumans() }}</p>

<br />
{{ config('app.name') }}
