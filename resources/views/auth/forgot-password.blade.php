<h2>Forgot Password</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/forgot-password">
    @csrf
    <input type="email" name="email" placeholder="Enter your email">
    <button type="submit">Send Reset Link</button>
</form>