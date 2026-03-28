<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — EduLearn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('CSS/register.css') }}">
</head>
<body>
<div class="bg-scene">
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
    <div class="grid-overlay"></div>
</div>

<div class="page">
    <div class="card">

        <!-- TOP BAR -->
        <div class="card-top">
            <div class="brand">
                <div class="brand-icon">🎓</div>
                <div class="brand-text">
                    <div class="brand-name">EduLearn</div>
                    <div class="brand-tag">Learning Reimagined</div>
                </div>
            </div>
            <div class="top-signin">Already a member? <a href="{{ route('login') }}">Sign in</a></div>
        </div>

        <!-- STEPS -->
        <div class="steps">
            <div class="step">
                <div class="step-circle active">1</div>
                <span class="step-label active">Account</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle active">2</div>
                <span class="step-label active">Details</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">3</div>
                <span class="step-label">Done</span>
            </div>
        </div>

        <!-- FORM BODY -->
        <div class="card-body">
            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="section-title">
                    <span class="dot"></span> Account Information
                </div>

                <div class="grid-2">

                    <!-- First Name -->
                    <div class="field">
                        <label for="first_name">First Name</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="John" autocomplete="given-name" required>
                        </div>
                        @error('first_name')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Last Name -->
                    <div class="field">
                        <label for="last_name">Last Name</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <input type="text" id="last_name" name="name" value="{{ old('last_name') }}" placeholder="Doe" autocomplete="family-name" required>
                        </div>
                        @error('last_name')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Username -->
                    <div class="field">
                        <label for="username">Username</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg></span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="johndoe" autocomplete="username" required>
                        </div>
                        @error('username')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Email -->
                    <div class="field">
                        <label for="email">Email Address</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required>
                        </div>
                        @error('email')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Password -->
                    <div class="field">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
                            <input type="password" id="password" name="password" placeholder="Min. 8 characters" autocomplete="new-password" required oninput="checkStrength(this.value)">
                        </div>
                        <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                        <div class="strength-hint" id="strength-hint">Use uppercase, numbers & symbols</div>
                        @error('password')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="field">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-wrap">
                            <span class="icon"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password" autocomplete="new-password" required>
                        </div>
                    </div>

                </div>

                <!-- Terms -->
                <div class="terms-wrap">
                    <input type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                    <span>
                        I agree to EduLearn's <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I understand my data will be used to personalize my learning experience.
                    </span>
                </div>
                @error('terms')
                    <span style="color:#f87171;font-size:0.8rem;display:block;margin-top:-1rem;margin-bottom:1rem;">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn-submit">
                    Create My EduLearn Account <span class="btn-arrow">→</span>
                </button>

            </form>
        </div>

    </div>
</div>

<script>
function checkStrength(val) {
    const fill = document.getElementById('strength-fill');
    const hint = document.getElementById('strength-hint');
    let score = 0;
    if (val.length >= 8)   score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const widths = ['0%','30%','55%','80%','100%'];
    const hints  = ['Too short','Weak','Fair','Good','Strong 🎉'];
    const colors = ['','#ef4444','#f59e0b','#3b82f6','#22c55e'];

    fill.style.width      = widths[score];
    fill.style.background = colors[score] || 'linear-gradient(90deg, #8b3cf7, #e879f9)';
    hint.textContent      = hints[score] || '';
    hint.style.color      = colors[score] || 'var(--text-muted)';
}
</script>
</body>
</html>