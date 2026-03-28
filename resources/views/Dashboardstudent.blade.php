{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
  <link rel="stylesheet" href="{{ url('CSS/Dashboardstudent.css') }}">
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
                Hi, <span>{{ auth()->user()->first_name ?? 'Yahya' }}!</span>
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
                <a href="#" class="btn-ghost">
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

{{-- COURSES --}}
<div>
    <div class="section-header anim anim-d2">
        <h2><span class="h-dot"></span> Available Courses</h2>
        <a href="#" class="see-all">View all →</a>
    </div>

    <div class="courses-grid">
        
        @forelse($courses as $index => $course)
        <div class="card course-card anim anim-d{{ min($index + 3, 6) }}">
            <div class="course-header">
                <div class="course-price">{{ $course->price }}</div>
            </div>
            <div>
                <div class="course-title">{{ $course->title }}</div>
                <div class="course-idea">💡 {{ $course->idea }}</div>
            </div>
            <div class="course-topics">
                @foreach($course->topics as $topic)
                    <span class="course-topic">{{ $topic }}</span>
                @endforeach
            </div>
            <div class="course-footer">
                <span class="pill pill-purple">{{ count($course->topics) }} topics</span>
                <div class="course-actions">
                    <form method="post" action="">
                        @csrf 
                        @method('PUT')
                    <button  class="course-btn course-btn-edit" title="Modify">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit
</button>
</form>
                <form method="post" action="">
                  @csrf 
                  @method('Delete')
                    <button class="course-btn course-btn-delete" title="Delete">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        Delete
</button>
</form>
                </div>
            </div>
        </div>
        @empty
        <div class="card no-courses">
            <p>No courses available yet. Check back soon!</p>
        </div>
        @endforelse
    </div>
</div>

{{-- FAB --}}
<a href="#" class="fab-add" title="Add Course">
    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
    </svg>
</a>

@endsection