<h2>Reset Password</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/reset-password">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="New Password"><br>

    <button type="submit">Reset Password</button>
</form>