{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
  <link rel="stylesheet" href="{{ url('CSS/Dashboardstudent.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <style>
    /* ── Register Form ── */
    .register-section { margin-bottom: 2rem; }

    .register-card {
      background: rgba(1,34,68,0.5);
      border: 1px solid rgba(55,138,221,0.2);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .register-card-top {
      background: linear-gradient(135deg, rgba(4,44,83,0.8), rgba(1,24,48,0.9));
      border-bottom: 1px solid rgba(55,138,221,0.15);
      padding: 1.5rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .register-brand { display: flex; align-items: center; gap: 0.85rem; }

    .register-brand-icon {
      width: 42px; height: 42px;
      background: linear-gradient(135deg, #2478c8, #38bdf8);
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
      box-shadow: 0 6px 18px rgba(36,120,200,0.4);
      flex-shrink: 0;
    }

    .register-brand-name {
      font-family: 'Syne', sans-serif;
      font-size: 1.35rem; font-weight: 800; letter-spacing: -0.03em;
      background: linear-gradient(135deg, #fff 30%, #b5d4f4);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }

    .register-brand-tag { font-size: 0.68rem; color: #6aaee8; letter-spacing: 0.1em; text-transform: uppercase; }

    .register-steps {
      display: flex; align-items: center; justify-content: center;
      padding: 1.5rem 2rem 0;
    }

    .reg-step { display: flex; align-items: center; gap: 0.5rem; flex: 1; max-width: 160px; }

    .reg-step-circle {
      width: 28px; height: 28px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem; font-weight: 600; flex-shrink: 0;
      background: rgba(55,138,221,0.1);
      border: 1.5px solid rgba(55,138,221,0.25);
      color: #6aaee8;
    }

    .reg-step-circle.active {
      background: linear-gradient(135deg, #2478c8, #185fa5);
      border-color: #378add; color: white;
      box-shadow: 0 4px 12px rgba(24,95,165,0.4);
    }

    .reg-step-label { font-size: 0.75rem; color: var(--muted); white-space: nowrap; }
    .reg-step-label.active { color: #b5d4f4; font-weight: 500; }
    .reg-step-line { flex: 1; height: 1.5px; background: rgba(55,138,221,0.15); margin: 0 0.5rem; }

    .register-form-body { padding: 2rem 2rem 2.5rem; }

    .reg-section-title {
      font-family: 'Syne', sans-serif;
      font-size: 1rem; font-weight: 700; color: var(--white);
      margin-bottom: 1.25rem; padding-bottom: 0.6rem;
      border-bottom: 1px solid rgba(55,138,221,0.12);
      display: flex; align-items: center; gap: 0.5rem;
    }

    .reg-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .reg-field { margin-bottom: 0; }

    .reg-field label {
      display: block; font-size: 0.75rem; font-weight: 500;
      color: #b5d4f4; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 0.4rem;
    }

    .reg-input-wrap { position: relative; }

    .reg-input-wrap .reg-icon {
      position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
      color: #378add; pointer-events: none; display: flex; align-items: center;
    }

    .reg-input-wrap input,
    .reg-input-wrap select {
      width: 100%; padding: 0.7rem 1rem 0.7rem 2.6rem;
      background: rgba(255,255,255,0.04);
      border: 1.5px solid rgba(55,138,221,0.2);
      border-radius: 12px; color: var(--white);
      font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
      outline: none;
      transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
      appearance: none; -webkit-appearance: none;
    }

    .reg-input-wrap input::placeholder { color: rgba(255,255,255,0.22); }

    .reg-input-wrap input:focus,
    .reg-input-wrap select:focus {
      border-color: #378add;
      background: rgba(55,138,221,0.06);
      box-shadow: 0 0 0 4px rgba(55,138,221,0.1);
    }

    .reg-input-wrap input:hover:not(:focus),
    .reg-input-wrap select:hover:not(:focus) { border-color: rgba(55,138,221,0.38); }

    .reg-input-wrap select option { background: #012244; color: #e2e8f0; }

    .reg-select-wrap { position: relative; }
    .reg-select-wrap::after {
      content: ''; position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);
      width: 0; height: 0;
      border-left: 5px solid transparent; border-right: 5px solid transparent;
      border-top: 6px solid rgba(55,138,221,0.6);
      pointer-events: none;
    }

    .role-badges { display: flex; gap: 0.4rem; margin-top: 0.5rem; flex-wrap: wrap; }

    .role-badge {
      display: inline-flex; align-items: center; gap: 0.3rem;
      padding: 0.2rem 0.6rem; border-radius: 999px;
      font-size: 0.7rem; font-weight: 600; letter-spacing: 0.03em;
      opacity: 0.3; transition: opacity 0.2s, transform 0.2s;
      cursor: default; border: 1px solid transparent;
    }

    .role-badge.active { opacity: 1; transform: scale(1.05); }
    .role-badge.badge-admin     { background: rgba(139,60,247,0.15); border-color: rgba(139,60,247,0.4); color: #c084fc; }
    .role-badge.badge-student   { background: rgba(34,197,94,0.12);  border-color: rgba(34,197,94,0.4);  color: #4ade80; }
    .role-badge.badge-formateur { background: rgba(59,130,246,0.12); border-color: rgba(59,130,246,0.4); color: #60a5fa; }

    .reg-strength-bar { margin-top: 0.5rem; height: 3px; border-radius: 99px; background: rgba(55,138,221,0.15); overflow: hidden; }
    .reg-strength-fill { height: 100%; width: 0%; border-radius: 99px; background: linear-gradient(90deg, #2478c8, #38bdf8); transition: width 0.4s ease; }
    .reg-strength-hint { font-size: 0.7rem; color: var(--muted); margin-top: 0.3rem; }

    .reg-terms-wrap {
      display: flex; align-items: flex-start; gap: 0.65rem;
      margin: 1.5rem 0 1.75rem; padding: 1rem 1.1rem;
      background: rgba(55,138,221,0.05);
      border: 1px solid rgba(55,138,221,0.12); border-radius: 12px;
    }

    .reg-terms-wrap input[type="checkbox"] { width: 17px; height: 17px; flex-shrink: 0; accent-color: #378add; margin-top: 2px; cursor: pointer; }
    .reg-terms-wrap span { font-size: 0.84rem; color: var(--muted); line-height: 1.6; }
    .reg-terms-wrap a { color: #6aaee8; text-decoration: none; font-weight: 500; transition: color 0.2s; }
    .reg-terms-wrap a:hover { color: #b5d4f4; }

    .reg-submit-btn {
      width: 100%; padding: 0.9rem;
      background: linear-gradient(135deg, #2478c8, #185fa5);
      border: none; border-radius: 12px; color: var(--white);
      font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 600;
      letter-spacing: 0.02em; cursor: pointer; position: relative; overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 8px 28px rgba(24,95,165,0.45);
    }

    .reg-submit-btn::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 60%);
      opacity: 0; transition: opacity 0.25s;
    }

    .reg-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(24,95,165,0.55); }
    .reg-submit-btn:hover::before { opacity: 1; }
    .reg-submit-btn:active { transform: translateY(0); }

    .reg-btn-arrow { margin-left: 0.4rem; transition: transform 0.2s; display: inline-block; }
    .reg-submit-btn:hover .reg-btn-arrow { transform: translateX(4px); }

    .reg-field-error { color: #f87171; font-size: 0.76rem; margin-top: 0.3rem; display: block; }

    @media (max-width: 700px) {
      .reg-grid-2 { grid-template-columns: 1fr; }
      .register-form-body { padding: 1.5rem 1.25rem 2rem; }
      .register-card-top  { padding: 1.25rem 1.25rem; }
      .register-steps     { padding: 1.25rem 1.25rem 0; }
    }

    /* ── Users Table ── */
    .users-section { margin-bottom: 3rem; }

    .users-table-card {
      background: rgba(1,34,68,0.5);
      border: 1px solid rgba(55,138,221,0.2);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .users-table-header {
      background: linear-gradient(135deg, rgba(4,44,83,0.8), rgba(1,24,48,0.9));
      border-bottom: 1px solid rgba(55,138,221,0.15);
      padding: 1.25rem 1.75rem;
      display: flex; align-items: center; justify-content: space-between;
      gap: 1rem; flex-wrap: wrap;
    }

    .users-table-title {
      font-family: 'Syne', sans-serif;
      font-size: 1rem; font-weight: 700; color: var(--white);
      display: flex; align-items: center; gap: 0.6rem;
    }

    .users-count-badge {
      font-size: 0.7rem; font-weight: 600;
      padding: 0.2rem 0.65rem; border-radius: 999px;
      background: rgba(55,138,221,0.15);
      border: 1px solid rgba(55,138,221,0.3);
      color: #6aaee8; letter-spacing: 0.03em;
    }

    .users-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }

    .users-table { width: 100%; border-collapse: collapse; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; }

    .users-table thead tr {
      background: rgba(55,138,221,0.07);
      border-bottom: 1px solid rgba(55,138,221,0.15);
    }

    .users-table thead th {
      padding: 0.85rem 1.5rem;
      text-align: left; font-size: 0.68rem; font-weight: 600;
      letter-spacing: 0.09em; text-transform: uppercase;
      color: #6aaee8; white-space: nowrap;
    }

    .users-table tbody tr {
      border-bottom: 1px solid rgba(55,138,221,0.07);
      transition: background 0.18s;
    }

    .users-table tbody tr:last-child { border-bottom: none; }
    .users-table tbody tr:hover { background: rgba(55,138,221,0.05); }

    .users-table tbody td {
      padding: 0.9rem 1.5rem;
      color: var(--white); vertical-align: middle;
    }

    .ut-id { color: #6aaee8; font-weight: 600; font-size: 0.8rem; font-family: monospace; }

    .ut-name-cell { display: flex; align-items: center; gap: 0.65rem; }

    .ut-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: linear-gradient(135deg, #2478c8, #38bdf8);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.68rem; font-weight: 700; color: white;
      flex-shrink: 0; text-transform: uppercase; letter-spacing: 0.03em;
    }

    .ut-fullname { font-weight: 500; color: var(--white); }
    .ut-email { color: rgba(255,255,255,0.5); font-size: 0.84rem; }

    .ut-role {
      display: inline-flex; align-items: center;
      padding: 0.22rem 0.7rem; border-radius: 999px;
      font-size: 0.69rem; font-weight: 600;
      letter-spacing: 0.04em; white-space: nowrap; text-transform: capitalize;
    }

    .ut-role-admin     { background: rgba(139,60,247,0.15); border: 1px solid rgba(139,60,247,0.35); color: #c084fc; }
    .ut-role-student   { background: rgba(34,197,94,0.12);  border: 1px solid rgba(34,197,94,0.35);  color: #4ade80; }
    .ut-role-formateur { background: rgba(55,138,221,0.12); border: 1px solid rgba(55,138,221,0.35); color: #60a5fa; }
    .ut-role-default   { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.45); }

    .ut-empty {
      text-align: center; padding: 3rem 1.5rem;
      color: rgba(255,255,255,0.3); font-size: 0.9rem;
      font-family: 'DM Sans', sans-serif;
    }

    @media (max-width: 640px) {
      .users-table thead th,
      .users-table tbody td { padding: 0.75rem 1rem; }
      .ut-avatar { display: none; }
      .ut-email  { display: none; }
    }
  </style>
@endpush

@section('content')

{{-- HERO --}}
<div class="hero anim">
    <div class="hero-bg-orb hero-bg-orb-1"></div>
    <div class="hero-bg-orb hero-bg-orb-2"></div>

    <div class="hero-grid">
        <div class="hero-content">
            <div class="hero-greeting">👋 Welcome back</div>
            <h1 class="hero-title">
                {{ auth()->user()->name}}<span></span>
            </h1>
            <p class="hero-sub">
                You have <strong>3 upcoming sessions</strong> this week and you're
                <strong>72% through</strong> your current training. Keep going!
            </p>
            <div class="hero-actions">
                <a href="#" class="btn-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    Continue Learning
                </a>
                <a href="schedule" class="btn-ghost">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    View Schedule
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="progress-card">
                <div class="progress-card-header">
                    <span class="progress-label">Weekly Progress</span>
                    <span class="progress-value">72%</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width:72%;"></div>
                </div>
                <div class="progress-days">
                    <span>Mon</span><span>Wed</span><span>Fri</span><span>Sun</span>
                </div>
            </div>
            <div class="hero-milestone">🏆 Next milestone: 85% completion</div>
        </div>
    </div>
</div>

{{-- REGISTER FORM --}}
<div class="register-section">

    <div class="section-header anim anim-d2">
        <h2><span class="h-dot"></span> Register New User</h2>
    </div>

    <div class="register-card anim anim-d3">

        <div class="register-card-top">
            <div class="register-brand">
                <div class="register-brand-icon">🎓</div>
                <div>
                    <div class="register-brand-name">EduLearn</div>
                    <div class="register-brand-tag">Learning Reimagined</div>
                </div>
            </div>
        </div>

        <div class="register-steps">
            <div class="reg-step">
                <div class="reg-step-circle active">1</div>
                <span class="reg-step-label active">Account</span>
            </div>
            <div class="reg-step-line"></div>
            <div class="reg-step">
                <div class="reg-step-circle active">2</div>
                <span class="reg-step-label active">Details</span>
            </div>
            <div class="reg-step-line"></div>
            <div class="reg-step">
                <div class="reg-step-circle">3</div>
                <span class="reg-step-label">Done</span>
            </div>
        </div>

        <div class="register-form-body">
            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="reg-section-title">
                    <span class="h-dot"></span> Account Information
                </div>

                <div class="reg-grid-2">

                    {{-- First Name --}}
                    <div class="reg-field">
                        <label for="first_name">First Name</label>
                        <div class="reg-input-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="John" autocomplete="given-name" required>
                        </div>
                        @error('first_name')<span class="reg-field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="reg-field">
                        <label for="last_name">Last Name</label>
                        <div class="reg-input-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Doe" autocomplete="family-name" required>
                        </div>
                        @error('last_name')<span class="reg-field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Role Select --}}
                    <div class="reg-field">
                        <label for="role">Role</label>
                        <div class="reg-input-wrap reg-select-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </span>
                            <select id="role" name="role" required onchange="updateRoleBadge(this.value)">
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role…</option>
                                <option value="admin"     {{ old('role') == 'admin'     ? 'selected' : '' }}>Admin</option>
                                <option value="student"   {{ old('role') == 'student'   ? 'selected' : '' }}>Student</option>
                                <option value="formateur" {{ old('role') == 'formateur' ? 'selected' : '' }}>Formateur</option>
                            </select>
                        </div>
                        <div class="role-badges">
                            <span class="role-badge badge-admin"     id="badge-admin">🛡 Admin</span>
                            <span class="role-badge badge-student"   id="badge-student">🎓 Student</span>
                            <span class="role-badge badge-formateur" id="badge-formateur">📚 Formateur</span>
                        </div>
                        @error('role')<span class="reg-field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="reg-field">
                        <label for="email">Email Address</label>
                        <div class="reg-input-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required>
                        </div>
                        @error('email')<span class="reg-field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Password --}}
                    <div class="reg-field">
                        <label for="password">Password</label>
                        <div class="reg-input-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" placeholder="Min. 8 characters" autocomplete="new-password" required oninput="checkRegStrength(this.value)">
                        </div>
                        <div class="reg-strength-bar">
                            <div class="reg-strength-fill" id="reg-strength-fill"></div>
                        </div>
                        <div class="reg-strength-hint" id="reg-strength-hint">Use uppercase, numbers &amp; symbols</div>
                        @error('password')<span class="reg-field-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="reg-field">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="reg-input-wrap">
                            <span class="reg-icon">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password" autocomplete="new-password" required>
                        </div>
                    </div>

                </div>

                {{-- Terms --}}
                <div class="reg-terms-wrap">
                    <input type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                    <span>
                        I agree to EduLearn's <a href="#">Terms of Service</a> and
                        <a href="#">Privacy Policy</a>. I understand my data will be
                        used to personalize my learning experience.
                    </span>
                </div>
                @error('terms')
                    <span class="reg-field-error" style="margin-top:-1rem;margin-bottom:1rem;">{{ $message }}</span>
                @enderror

                <button type="submit" class="reg-submit-btn">
                    Create My EduLearn Account <span class="reg-btn-arrow">→</span>
                </button>

            </form>
        </div>
    </div>
</div>

{{-- USERS TABLE --}}
<div class="users-section">

    <div class="section-header anim anim-d2">
        <h2><span class="h-dot"></span> All Users</h2>
        <span class="see-all">{{ $users->count() }} total</span>
    </div>

    <div class="users-table-card anim anim-d3">

        <div class="users-table-header">
            <div class="users-table-title">
                <svg width="16" height="16" fill="none" stroke="#378add" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Registered Users
            </div>
            <span class="users-count-badge">{{ $users->count() }} users</span>
        </div>
<div class="users-table-wrap">
    <table class="users-table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th> </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                @php
                    $initials = strtoupper(
                        substr($user->first_name ?? $user->name ?? '?', 0, 2) .
                        substr($user->last_name ?? '', 0, 1)
                    );
                    $fullName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''))
                        ?: ($user->name ?? 'Unknown');
                    $role      = strtolower($user->role ?? 'user');
                    $roleClass = in_array($role, ['admin', 'student', 'formateur'])
                        ? 'ut-role-' . $role
                        : 'ut-role-default';
                @endphp
                <tr>
                    <td><span class="ut-id">{{ $user->id }}</span></td>
                    <td>
                        <div class="ut-name-cell">
                            <div class="ut-avatar">{{ $initials }}</div>
                            <span class="ut-fullname">{{ $fullName }}</span>
                        </div>
                    </td>
                    <td><span class="ut-email">{{ $user->email }}</span></td>
                    <td><span class="ut-role {{ $roleClass }}">{{ ucfirst($role) }}</span></td>
                    <td>
                        <form  action="{{ route('delete', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ut-btn-delete">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
         fill="none" stroke="currentColor" stroke-width="2"
         stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18"/>
        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
    </svg>
    <span class="ut-btn-delete-label">Delete</span>
</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="ut-empty">No users found yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
/* Role badge highlight */
function updateRoleBadge(val) {
    ['admin', 'student', 'formateur'].forEach(function(r) {
        document.getElementById('badge-' + r).classList.toggle('active', r === val);
    });
}

/* Pre-select badge on load (after validation failures with old() values) */
(function () {
    var sel = document.getElementById('role');
    if (sel && sel.value) updateRoleBadge(sel.value);
})();

/* Password strength meter */
function checkRegStrength(val) {
    var fill = document.getElementById('reg-strength-fill');
    var hint = document.getElementById('reg-strength-hint');
    var score = 0;
    if (val.length >= 8)          score++;
    if (/[A-Z]/.test(val))        score++;
    if (/[0-9]/.test(val))        score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    var widths = ['0%', '30%', '55%', '80%', '100%'];
    var hints  = ['Too short', 'Weak', 'Fair', 'Good', 'Strong 🎉'];
    var colors = ['', '#ef4444', '#f59e0b', '#378add', '#38bdf8'];

    fill.style.width      = widths[score];
    fill.style.background = colors[score] || 'linear-gradient(90deg, #2478c8, #38bdf8)';
    hint.textContent      = hints[score] || '';
    hint.style.color      = colors[score] || 'var(--muted)';
}

</script>
@endpush