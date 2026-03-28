<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — EduLearn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('CSS/login.css') }}">
</head>
<body>
<div class="bg-scene">
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
    <div class="grid-overlay"></div>
</div>

<div class="page">
    <div class="split">

        <!-- LEFT PANEL -->
        <div class="panel-left">
            <div class="brand">
                <div class="brand-icon">🎓</div>
                <div class="brand-name">EduLearn</div>
                <div class="brand-tag">Learning Reimagined</div>
            </div>

            <div class="panel-copy">
                <h2>Unlock your full learning potential</h2>
                <p>Access thousands of expert-led courses, track your progress, and earn certificates that matter.</p>
            </div>

            <div class="stats">
                <div class="stat-item">
                    <div class="stat-num">12K+</div>
                    <div class="stat-label">Courses</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">98K+</div>
                    <div class="stat-label">Students</div>
                </div>
                <div class="stat-item">
                    <div class="stat-num">500+</div>
                    <div class="stat-label">Instructors</div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="panel-right">
            <div class="form-header">
                <h1>Welcome back 👋</h1>
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up for free</a></p>
            </div>

            <form method="POST" action="{{ route('login.post') }}" novalidate>
                @csrf

                <!-- Email -->
                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <span class="icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            required
                        >
                    </div>
                    @error('email')
                        <span style="color:#f87171;font-size:0.8rem;margin-top:0.35rem;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <span class="icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                    @error('password')
                        <span style="color:#f87171;font-size:0.8rem;margin-top:0.35rem;display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="field-row">
                    <label class="checkbox-wrap">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                        <a class="forgot-link" >Forgot password?</a>
                </div>

                <!-- Submit -->
               <button type="submit" class="btn-submit">Sign In to EduLearn</button>

<div class="auth-links">
    <a href="{{ route('register') }}">Create an account</a>
   
</div>
            </form>

          

    </div>
</div>
</body>
</html>



























