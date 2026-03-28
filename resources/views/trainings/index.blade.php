{{-- resources/views/trainings/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Trainings')
@section('page-title', 'Trainings & Courses')

@push('styles')
<style>
    /* ── Page header ── */
    .page-hero {
        background: linear-gradient(135deg, rgba(74,17,150,0.4), rgba(15,5,32,0.5));
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1.75rem 2rem;
        margin-bottom: 1.75rem;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem;
    }
    .page-hero h1 {
        font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800;
        letter-spacing: -0.02em; color: var(--white);
    }
    .page-hero p { font-size: 0.88rem; color: var(--muted); margin-top: 0.25rem; }
    .page-hero-right { display: flex; gap: 0.75rem; align-items: center; }

    /* ── Filter bar ── */
    .filter-bar {
        display: flex; gap: 0.75rem; flex-wrap: wrap;
        margin-bottom: 1.75rem; align-items: center;
    }
    .search-wrap {
        position: relative; flex: 1; min-width: 220px;
    }
    .search-wrap svg {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: var(--muted); pointer-events: none;
    }
    .search-wrap input {
        width: 100%;
        padding: 0.65rem 1rem 0.65rem 2.5rem;
        background: rgba(255,255,255,0.04);
        border: 1.5px solid var(--border);
        border-radius: 12px; color: var(--white);
        font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
        outline: none; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-wrap input::placeholder { color: rgba(255,255,255,0.25); }
    .search-wrap input:focus { border-color: var(--purple-500); box-shadow: 0 0 0 4px rgba(168,85,247,0.1); }

    .filter-select {
        padding: 0.65rem 2rem 0.65rem 0.9rem;
        background: rgba(255,255,255,0.04);
        border: 1.5px solid var(--border);
        border-radius: 12px; color: var(--white);
        font-family: 'DM Sans', sans-serif; font-size: 0.85rem;
        outline: none; cursor: pointer; appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 10px center;
        transition: border-color 0.2s;
    }
    .filter-select option { background: #1a0533; }
    .filter-select:focus { border-color: var(--purple-500); outline: none; }

    /* ── Filter pills ── */
    .filter-pills { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
    .filter-pill {
        padding: 0.35rem 0.9rem; border-radius: 99px; font-size: 0.78rem; font-weight: 500;
        cursor: pointer; border: 1px solid var(--border);
        background: var(--surface); color: var(--muted);
        transition: all 0.2s;
    }
    .filter-pill:hover { border-color: rgba(168,85,247,0.3); color: var(--purple-300); }
    .filter-pill.active {
        background: linear-gradient(135deg, rgba(139,60,247,0.25), rgba(107,33,200,0.15));
        border-color: rgba(168,85,247,0.4); color: var(--purple-300);
    }

    /* ── Results meta ── */
    .results-meta {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;
    }
    .results-count { font-size: 0.85rem; color: var(--muted); }
    .results-count strong { color: var(--white); }
    .view-toggle { display: flex; gap: 4px; }
    .view-btn {
        width: 34px; height: 34px; border-radius: 8px;
        background: var(--surface); border: 1px solid var(--border);
        color: var(--muted); cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .view-btn.active { background: rgba(168,85,247,0.15); border-color: rgba(168,85,247,0.3); color: var(--purple-300); }

    /* ── Training Grid ── */
    .trainings-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem; margin-bottom: 2rem;
    }

    .training-card {
        border-radius: 18px; overflow: hidden;
        cursor: pointer; text-decoration: none; color: inherit; display: block;
        transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
    }
    .training-card:hover { transform: translateY(-6px); box-shadow: 0 24px 60px rgba(0,0,0,0.5); }

    .tc-cover {
        height: 130px; display: flex; align-items: center; justify-content: center;
        font-size: 3rem; position: relative; overflow: hidden;
    }
    .tc-cover::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.6));
    }
    .tc-cover-badge {
        position: absolute; top: 12px; right: 12px; z-index: 1;
    }

    .tc-body { padding: 1.1rem 1.25rem 1.25rem; }
    .tc-category {
        font-size: 0.7rem; font-weight: 600; letter-spacing: 0.1em;
        text-transform: uppercase; color: var(--purple-400); margin-bottom: 0.4rem;
    }
    .tc-title {
        font-family: 'Syne', sans-serif; font-size: 0.95rem; font-weight: 700;
        color: var(--white); line-height: 1.35; margin-bottom: 0.5rem;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .tc-meta {
        display: flex; gap: 0.75rem; flex-wrap: wrap;
        font-size: 0.75rem; color: var(--muted); margin-bottom: 0.85rem;
    }
    .tc-meta span { display: flex; align-items: center; gap: 3px; }
    .tc-instructor {
        display: flex; align-items: center; gap: 0.5rem;
        padding-top: 0.75rem; border-top: 1px solid var(--border);
    }
    .tc-instructor-avatar {
        width: 24px; height: 24px; border-radius: 50%;
        background: linear-gradient(135deg, var(--purple-600), var(--accent));
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700; flex-shrink: 0;
    }
    .tc-instructor-name { font-size: 0.78rem; color: var(--muted); flex: 1; }
    .tc-rating { font-size: 0.78rem; color: var(--gold); display: flex; align-items: center; gap: 2px; }

    /* ── Pagination ── */
    .pagination {
        display: flex; align-items: center; justify-content: center; gap: 0.4rem;
    }
    .page-btn {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--surface); border: 1px solid var(--border);
        color: var(--muted); cursor: pointer; font-size: 0.85rem;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    }
    .page-btn:hover { background: rgba(168,85,247,0.1); color: var(--purple-300); border-color: rgba(168,85,247,0.3); }
    .page-btn.active { background: linear-gradient(135deg, var(--purple-600), var(--purple-800)); border-color: transparent; color: white; }
    .page-btn:disabled { opacity: 0.35; cursor: not-allowed; }

    /* ── Responsive ── */
    @media (max-width: 1100px) { .trainings-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 700px)  { .trainings-grid { grid-template-columns: 1fr; } }
    @media (max-width: 600px)  { .page-hero { flex-direction: column; } .filter-bar { flex-direction: column; } .filter-select, .search-wrap { width: 100%; } }
</style>
@endpush

@section('content')

{{-- PAGE HERO --}}
<div class="page-hero anim">
    <div>
        <h1>Trainings & Courses</h1>
        <p>Explore {{ $totalCount ?? '24' }} expert-led programs across every discipline.</p>
    </div>
    <div class="page-hero-right">
        <a href="#" class="btn-primary" style="padding:0.6rem 1.2rem;background:linear-gradient(135deg,var(--purple-600),var(--purple-800));border:none;border-radius:10px;color:white;font-family:'DM Sans',sans-serif;font-size:0.85rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem;box-shadow:0 6px 20px rgba(107,33,200,0.35);transition:transform 0.2s;">
            🔖 My Enrollments
        </a>
    </div>
</div>

{{-- SEARCH & FILTERS --}}
<form method="GET" action="{{ route('trainings.index') }}" id="filter-form">
<div class="filter-bar anim anim-d1">
    <div class="search-wrap">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="search" placeholder="Search trainings, topics, instructors…" value="{{ request('search') }}">
    </div>
    <select name="category" class="filter-select" onchange="document.getElementById('filter-form').submit()">
        <option value="">All Categories</option>
        <option value="programming" {{ request('category') === 'programming' ? 'selected' : '' }}>💻 Programming</option>
        <option value="design" {{ request('category') === 'design' ? 'selected' : '' }}>🎨 Design</option>
        <option value="data" {{ request('category') === 'data' ? 'selected' : '' }}>📊 Data Science</option>
        <option value="business" {{ request('category') === 'business' ? 'selected' : '' }}>💼 Business</option>
        <option value="marketing" {{ request('category') === 'marketing' ? 'selected' : '' }}>📣 Marketing</option>
        <option value="security" {{ request('category') === 'security' ? 'selected' : '' }}>🔒 Cybersecurity</option>
    </select>
    <select name="level" class="filter-select" onchange="document.getElementById('filter-form').submit()">
        <option value="">All Levels</option>
        <option value="beginner" {{ request('level') === 'beginner' ? 'selected' : '' }}>🌱 Beginner</option>
        <option value="intermediate" {{ request('level') === 'intermediate' ? 'selected' : '' }}>⚡ Intermediate</option>
        <option value="advanced" {{ request('level') === 'advanced' ? 'selected' : '' }}>🔥 Advanced</option>
    </select>
    <select name="language" class="filter-select" onchange="document.getElementById('filter-form').submit()">
        <option value="">All Languages</option>
        <option value="english" {{ request('language') === 'english' ? 'selected' : '' }}>🇬🇧 English</option>
        <option value="french" {{ request('language') === 'french' ? 'selected' : '' }}>🇫🇷 French</option>
        <option value="arabic" {{ request('language') === 'arabic' ? 'selected' : '' }}>🇸🇦 Arabic</option>
        <option value="spanish" {{ request('language') === 'spanish' ? 'selected' : '' }}>🇪🇸 Spanish</option>
    </select>
    <select name="sort" class="filter-select" onchange="document.getElementById('filter-form').submit()">
        <option value="newest" {{ request('sort','newest') === 'newest' ? 'selected' : '' }}>🕐 Newest</option>
        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>🔥 Most Popular</option>
        <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>⭐ Top Rated</option>
    </select>
</div>

{{-- QUICK-FILTER PILLS --}}
<div class="filter-pills anim anim-d2">
    @foreach(['All','Programming','Design','Data Science','Business','Marketing','Cybersecurity'] as $tag)
        <button type="button"
            class="filter-pill {{ (request('category', 'all') === strtolower(str_replace(' ','-',$tag)) || ($tag === 'All' && !request('category'))) ? 'active' : '' }}"
            onclick="setCategory('{{ strtolower(str_replace(' ','-',$tag)) === 'all' ? '' : strtolower(str_replace(' ','-',$tag)) }}')">
            {{ $tag }}
        </button>
    @endforeach
</div>

</form>

{{-- RESULTS META --}}
<div class="results-meta anim anim-d3">
    <div class="results-count">Showing <strong>{{ $trainings->count() ?? 9 }}</strong> of <strong>{{ $totalCount ?? 24 }}</strong> trainings</div>
    <div style="display:flex;align-items:center;gap:0.75rem;">
        <div class="view-toggle">
            <button class="view-btn active" title="Grid view">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
            </button>
            <button class="view-btn" title="List view">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
        </div>
    </div>
</div>

{{-- TRAININGS GRID --}}
<div class="trainings-grid">
    @forelse($trainings ?? [] as $i => $training)
        <a href="{{ route('trainings.show', $training->id) }}" class="card training-card anim anim-d{{ min($i+3,6) }}">
            <div class="tc-cover" style="background:{{ $training->cover_color ?? 'linear-gradient(135deg,#4a1196,#8b3cf7)' }};">
                <span style="position:relative;z-index:1;">{{ $training->emoji ?? '📘' }}</span>
                <div class="tc-cover-badge">
                    <span class="pill {{ $training->level === 'beginner' ? 'pill-green' : ($training->level === 'advanced' ? 'pill-pink' : 'pill-amber') }}">
                        {{ ucfirst($training->level ?? 'Intermediate') }}
                    </span>
                </div>
            </div>
            <div class="tc-body">
                <div class="tc-category">{{ $training->category ?? 'Programming' }}</div>
                <div class="tc-title">{{ $training->title }}</div>
                <div class="tc-meta">
                    <span>📅 {{ $training->duration ?? '12h' }}</span>
                    <span>🌐 {{ $training->language ?? 'English' }}</span>
                    <span>👥 {{ $training->enrolled_count ?? '0' }} enrolled</span>
                </div>
                <div class="tc-instructor">
                    <div class="tc-instructor-avatar">{{ strtoupper(substr($training->instructor ?? 'I', 0, 1)) }}</div>
                    <span class="tc-instructor-name">{{ $training->instructor ?? 'Instructor' }}</span>
                    <div class="tc-rating">★ {{ number_format($training->rating ?? 4.7, 1) }}</div>
                </div>
            </div>
        </a>
    @empty
        {{-- Static fallback cards --}}
        @php
        $cards = [
            ['emoji'=>'🐍','title'=>'Python for Data Science','category'=>'Data Science','level'=>'Intermediate','level_pill'=>'pill-amber','duration'=>'18h','language'=>'English','enrolled'=>'2.4k','instructor'=>'Dr. Sarah Mills','rating'=>4.9,'bg'=>'linear-gradient(135deg,#1e3a5f,#2563eb)'],
            ['emoji'=>'🎨','title'=>'UI/UX Design Fundamentals','category'=>'Design','level'=>'Beginner','level_pill'=>'pill-green','duration'=>'10h','language'=>'English','enrolled'=>'1.8k','instructor'=>'Alex Torres','rating'=>4.8,'bg'=>'linear-gradient(135deg,#4a1196,#8b3cf7)'],
            ['emoji'=>'⚡','title'=>'JavaScript Advanced Patterns','category'=>'Programming','level'=>'Advanced','level_pill'=>'pill-pink','duration'=>'14h','language'=>'English','enrolled'=>'980','instructor'=>'James Okafor','rating'=>4.7,'bg'=>'linear-gradient(135deg,#713f12,#d97706)'],
            ['emoji'=>'🔒','title'=>'Ethical Hacking & Pentesting','category'=>'Cybersecurity','level'=>'Advanced','level_pill'=>'pill-pink','duration'=>'22h','language'=>'English','enrolled'=>'670','instructor'=>'Nadia Benali','rating'=>4.9,'bg'=>'linear-gradient(135deg,#1a0533,#6b21c8)'],
            ['emoji'=>'📊','title'=>'Business Intelligence with Power BI','category'=>'Business','level'=>'Beginner','level_pill'=>'pill-green','duration'=>'8h','language'=>'French','enrolled'=>'1.1k','instructor'=>'Marc Dupont','rating'=>4.6,'bg'=>'linear-gradient(135deg,#0f3443,#27ae60)'],
            ['emoji'=>'🤖','title'=>'Machine Learning with Python','category'=>'Data Science','level'=>'Intermediate','level_pill'=>'pill-amber','duration'=>'24h','language'=>'English','enrolled'=>'3.2k','instructor'=>'Dr. Ali Hassan','rating'=>4.8,'bg'=>'linear-gradient(135deg,#1a0533,#e879f9)'],
            ['emoji'=>'📱','title'=>'React Native Mobile Development','category'=>'Programming','level'=>'Intermediate','level_pill'=>'pill-amber','duration'=>'16h','language'=>'English','enrolled'=>'890','instructor'=>'Sofia Reyes','rating'=>4.7,'bg'=>'linear-gradient(135deg,#0c1a3a,#1d4ed8)'],
            ['emoji'=>'📣','title'=>'Digital Marketing Mastery','category'=>'Marketing','level'=>'Beginner','level_pill'=>'pill-green','duration'=>'6h','language'=>'Arabic','enrolled'=>'2.1k','instructor'=>'Youssef Amrani','rating'=>4.5,'bg'=>'linear-gradient(135deg,#3b0a0a,#dc2626)'],
            ['emoji'=>'☁️','title'=>'AWS Cloud Practitioner','category'=>'Programming','level'=>'Beginner','level_pill'=>'pill-green','duration'=>'12h','language'=>'English','enrolled'=>'1.5k','instructor'=>'Chen Wei','rating'=>4.8,'bg'=>'linear-gradient(135deg,#0c2340,#0369a1)'],
        ];
        @endphp
        @foreach($cards as $i => $c)
        <a href="#" class="card training-card anim anim-d{{ min($i+3,6) }}">
            <div class="tc-cover" style="background:{{ $c['bg'] }};">
                <span style="position:relative;z-index:1;">{{ $c['emoji'] }}</span>
                <div class="tc-cover-badge">
                    <span class="pill {{ $c['level_pill'] }}">{{ $c['level'] }}</span>
                </div>
            </div>
            <div class="tc-body">
                <div class="tc-category">{{ $c['category'] }}</div>
                <div class="tc-title">{{ $c['title'] }}</div>
                <div class="tc-meta">
                    <span>📅 {{ $c['duration'] }}</span>
                    <span>🌐 {{ $c['language'] }}</span>
                    <span>👥 {{ $c['enrolled'] }} enrolled</span>
                </div>
                <div class="tc-instructor">
                    <div class="tc-instructor-avatar">{{ strtoupper(substr($c['instructor'],0,1)) }}</div>
                    <span class="tc-instructor-name">{{ $c['instructor'] }}</span>
                    <div class="tc-rating">★ {{ $c['rating'] }}</div>
                </div>
            </div>
        </a>
        @endforeach
    @endforelse
</div>

{{-- PAGINATION --}}
<div class="pagination anim anim-d6">
    @if(isset($trainings) && $trainings instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $trainings->withQueryString()->links() }}
    @else
        <button class="page-btn" disabled>‹</button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <span style="color:var(--muted);font-size:0.85rem;padding:0 4px;">…</span>
        <button class="page-btn">8</button>
        <button class="page-btn">›</button>
    @endif
</div>

@endsection

@push('scripts')
<script>
function setCategory(val) {
    const form = document.getElementById('filter-form');
    const sel  = form.querySelector('[name="category"]');
    sel.value  = val;
    form.submit();
}
// View toggle
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>
@endpush