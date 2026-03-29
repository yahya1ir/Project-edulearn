{{-- resources/views/absence.blade.php --}}
@extends('layouts.app')

@section('title', "Fiche d'absence")
@section('page-title', "Fiche d'absence")

@push('styles')
<style>
    .absence-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .absence-header-left h1 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.3rem, 2.5vw, 1.7rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }
    .absence-header-left h1 .h-dot {
        width: 9px; height: 9px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-500), var(--accent));
        display: inline-block;
        flex-shrink: 0;
    }
    .absence-header-left p {
        font-size: 0.85rem;
        color: var(--muted);
        margin-top: 0.3rem;
    }
    .absence-meta {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.85rem;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid var(--border);
        color: var(--muted);
        background: rgba(255,255,255,0.03);
    }
    .meta-pill svg { opacity: 0.6; }

    .table-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
    }
    .table-card-header {
        padding: 1.1rem 1.6rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .table-card-header-title {
        font-family: 'Syne', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .count-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 99px;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-800));
        color: white;
    }
    .table-summary {
        display: flex;
        gap: 1rem;
        font-size: 0.78rem;
    }
    .summary-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: var(--muted);
    }
    .summary-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .dot-present { background: #4ade80; }
    .dot-absent  { background: #f87171; }

    .absence-table {
        width: 100%;
        border-collapse: collapse;
    }
    .absence-table thead th {
        padding: 0.75rem 1.6rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: rgba(55,138,221,0.6);
        background: rgba(55,138,221,0.04);
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }
    .absence-table thead th:last-child { text-align: center; }

    .absence-table tbody tr {
        border-bottom: 1px solid rgba(55,138,221,0.07);
        transition: background 0.18s;
    }
    .absence-table tbody tr:last-child { border-bottom: none; }
    .absence-table tbody tr:hover { background: rgba(55,138,221,0.05); }

    .absence-table tbody td {
        padding: 0.9rem 1.6rem;
        font-size: 0.88rem;
        color: var(--white);
        vertical-align: middle;
    }
    .absence-table tbody td:last-child { text-align: center; }

    .row-num {
        font-size: 0.72rem;
        color: rgba(55,138,221,0.4);
        font-weight: 600;
        min-width: 24px;
    }

    .name-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .row-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-700), var(--blue-500));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
        border: 1px solid rgba(55,138,221,0.25);
    }
    .name-text {
        font-weight: 600;
        color: var(--white);
    }
    .prenom-text {
        color: var(--blue-300);
        font-weight: 400;
    }

    /* hide the form visually, keep it functional */
    .toggle-form { display: inline; }

    .toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.28rem 0.85rem;
        border-radius: 99px;
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
        background: none;
    }
    .toggle-btn::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .toggle-btn.btn-present {
        background: rgba(34,197,94,0.1);
        border-color: rgba(34,197,94,0.25);
        color: #4ade80;
    }
    .toggle-btn.btn-present::before {
        background: #4ade80;
        box-shadow: 0 0 5px rgba(74,222,128,0.6);
    }
    .toggle-btn.btn-absent {
        background: rgba(248,113,113,0.1);
        border-color: rgba(248,113,113,0.25);
        color: #f87171;
    }
    .toggle-btn.btn-absent::before {
        background: #f87171;
        box-shadow: 0 0 5px rgba(248,113,113,0.5);
    }
    .toggle-btn:hover {
        filter: brightness(1.2);
        transform: scale(1.04);
    }

    .table-footer {
        padding: 0.85rem 1.6rem;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.78rem;
        color: var(--muted);
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    @media (max-width: 600px) {
        .absence-table thead th,
        .absence-table tbody td { padding: 0.75rem 1rem; }
        .name-cell { gap: 0.5rem; }
        .row-avatar { display: none; }
    }
</style>
@endpush

@section('content')

<div class="absence-header anim">
    <div class="absence-header-left">
        <h1>
            <span class="h-dot"></span>
            Fiche d'absence
        </h1>
        <p>Suivi des présences — Session du 29 Mars 2026</p>
    </div>
    <div class="absence-meta">
        <span class="meta-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            29 / 03 / 2026
        </span>
        <span class="meta-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            09:00 — 12:00
        </span>
        <span class="meta-pill">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Groupe A
        </span>
    </div>
</div>

<div class="table-card anim anim-d1">

    <div class="table-card-header">
        <div class="table-card-header-title">
            Liste des stagiaires
            <span class="count-badge">{{ $students->count() }}</span>
        </div>
        <div class="table-summary">
            <span class="summary-item">
                <span class="summary-dot dot-present"></span>
                Présents : <span id="count-present">0</span>
            </span>
            <span class="summary-item">
                <span class="summary-dot dot-absent"></span>
                Absents : <span id="count-absent">{{ $students->count() }}</span>
            </span>
        </div>
    </div>

    <table class="absence-table">
        <thead>
            <tr>
                <th style="width:40px;">#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($students as $index => $student)
            @php
                $initials = strtoupper(substr($student->name, 0, 2));
            @endphp
            <tr>
                <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <div class="name-cell">
                        <div class="row-avatar">{{ $initials }}</div>
                        <span class="name-text">{{ $student->name }}</span>
                    </div>
                </td>
                <td class="prenom-text">{{ $student->email }}</td>
                <td>
                    <form
                        class="toggle-form"
                        action="{{ route('absence.toggle', $student->email) }}"
                        method="POST"
                    >
                        @csrf
                       
                         <button
        type="submit"
        onclick="handleToggle(event, this)"
        class="toggle-btn {{ $student->statut === 'present' ? 'btn-present' : 'btn-absent' }}"
        data-status="{{ $student->statut }}"
    >
        {{ $student->statut === 'present' ? 'Présent' : 'Absent' }}
    </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="table-footer">
        <span>{{ $students->count() }} stagiaires — Session Matin</span>
        <span>Taux de présence :
            <strong style="color:var(--white);" id="taux">0 %</strong>
        </span>
    </div>

</div>

@endsection

@push('scripts')
<script>
    function handleToggle(event, btn) {
        event.preventDefault(); // stop page reload

        const currentStatus = btn.dataset.status;
        const newStatus = currentStatus === 'present' ? 'absent' : 'present';

        // Update button visually
        btn.classList.remove(currentStatus === 'present' ? 'btn-present' : 'btn-absent');
        btn.classList.add(newStatus === 'present' ? 'btn-present' : 'btn-absent');
        btn.textContent = newStatus === 'present' ? 'Présent' : 'Absent';
        btn.dataset.status = newStatus;

        // Update live counters
        const allBtns = document.querySelectorAll('.toggle-btn');
        let presentCount = 0;
        allBtns.forEach(b => { if (b.dataset.status === 'present') presentCount++; });
        const total = allBtns.length;

        document.getElementById('count-present').textContent = presentCount;
        document.getElementById('count-absent').textContent = total - presentCount;
        document.getElementById('taux').textContent = Math.round(presentCount / total * 100) + ' %';

        // Submit the form via fetch (PUT)
        const form = btn.closest('form');
        const url = form.action;
        const token = form.querySelector('input[name="_token"]').value;

     fetch(url, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': token,
    },
});
    }
    
</script>
@endpush