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

  <style>
    /* ── Role Select Styling ── */
    .input-wrap select {
      width: 100%;
      background: transparent;
      border: none;
      outline: none;
      color: inherit;
      font-family: inherit;
      font-size: 0.9rem;
      padding-left: 0.25rem;
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
    }

    .input-wrap select option {
      background: #1a1a2e;
      color: #e2e8f0;
    }

    /* Dropdown arrow */
    .input-wrap.select-wrap {
      position: relative;
    }

    .input-wrap.select-wrap::after {
      content: '';
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 6px solid currentColor;
      opacity: 0.5;
      pointer-events: none;
    }

    /* Role badge pills */
    .role-badges {
      display: flex;
      gap: 0.45rem;
      margin-top: 0.55rem;
      flex-wrap: wrap;
    }

    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      padding: 0.22rem 0.65rem;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.03em;
      opacity: 0.35;
      transition: opacity 0.2s, transform 0.2s;
      cursor: default;
      border: 1px solid transparent;
    }

    .role-badge.active {
      opacity: 1;
      transform: scale(1.05);
    }

    .role-badge.badge-admin     { background: rgba(139,60,247,0.15); border-color: rgba(139,60,247,0.4); color: #c084fc; }
    .role-badge.badge-student   { background: rgba(34,197,94,0.12);  border-color: rgba(34,197,94,0.4);  color: #4ade80; }
    .role-badge.badge-formateur { background: rgba(59,130,246,0.12); border-color: rgba(59,130,246,0.4); color: #60a5fa; }
  </style>
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
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Doe" autocomplete="family-name" required>
                        </div>
                        @error('last_name')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <!-- Role Select -->
                    <div class="field">
                        <label for="role">Role</label>
                        <div class="input-wrap select-wrap">
                            <span class="icon">
                               
                            </span>
                            <select id="role" name="role" required onchange="updateBadge(this.value)">
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role…</option>
                                <option value="admin"      {{ old('role') == 'admin'      ? 'selected' : '' }}>Admin</option>
                                <option value="student"    {{ old('role') == 'student'    ? 'selected' : '' }}>Student</option>
                                <option value="formateur"  {{ old('role') == 'formateur'  ? 'selected' : '' }}>Formateur</option>
                            </select>
                        </div>

                        <!-- Visual role badges -->
                        <div class="role-badges">
                            <span class="role-badge badge-admin"      id="badge-admin">🛡 Admin</span>
                            <span class="role-badge badge-student"    id="badge-student">🎓 Student</span>
                            <span class="role-badge badge-formateur"  id="badge-formateur">📚 Formateur</span>
                        </div>

                        @error('role')<span style="color:#f87171;font-size:0.78rem;margin-top:0.3rem;display:block;">{{ $message }}</span>@enderror
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
/* ── Role badge highlight ── */
function updateBadge(val) {
    ['admin','student','formateur'].forEach(function(r) {
        document.getElementById('badge-' + r).classList.toggle('active', r === val);
    });
}

/* Pre-select badge on page load (for old() values after validation fail) */
(function() {
    const sel = document.getElementById('role');
    if (sel && sel.value) updateBadge(sel.value);
})();

/* ── Password strength ── */
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