{{-- resources/views/schedules/index.blade.php --}}
{{--
    This view REPLACES the standalone schedule.blade.php.
    It keeps the exact same design (drop zone, file-info bar, preview, animations)
    and wires the form to the real Laravel upload route.
--}}
@extends('layouts.app')

@section('title', 'Schedule')
@section('page-title', 'Schedule')

@push('styles')
<style>
    /* ── Page header ── */
    .page-header {
        margin-bottom: 2rem;
    }
    .page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        background: linear-gradient(135deg, #fff 30%, var(--blue-300));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.35rem;
    }
    .page-header p {
        color: var(--muted);
        font-size: 0.9rem;
    }

    /* ── Alert banners ── */
    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        border-radius: 14px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.4s cubic-bezier(0.22,1,0.36,1) both;
    }
    .alert-success {
        background: rgba(34, 197, 94, 0.10);
        border: 1px solid rgba(34, 197, 94, 0.25);
        color: #4ade80;
    }
    .alert-error {
        background: rgba(239, 68, 68, 0.10);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #f87171;
    }

    /* ── Upload zone (unchanged from original design) ── */
    .upload-zone {
        border: 2px dashed rgba(55, 138, 221, 0.3);
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.02);
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.25s, background 0.25s, transform 0.2s;
        position: relative;
        overflow: hidden;
    }
    .upload-zone::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(55, 138, 221, 0.06), transparent);
        pointer-events: none;
    }
    .upload-zone:hover,
    .upload-zone.drag-over {
        border-color: rgba(55, 138, 221, 0.65);
        background: rgba(55, 138, 221, 0.05);
        transform: translateY(-2px);
    }
    .upload-zone.drag-over {
        border-color: var(--accent);
        background: rgba(56, 189, 248, 0.07);
    }

    .upload-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(55, 138, 221, 0.18), rgba(56, 189, 248, 0.1));
        border: 1px solid rgba(55, 138, 221, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        box-shadow: 0 8px 24px rgba(55, 138, 221, 0.15);
        transition: transform 0.25s, box-shadow 0.25s;
    }
    .upload-zone:hover .upload-icon-wrap {
        transform: scale(1.08);
        box-shadow: 0 12px 32px rgba(55, 138, 221, 0.25);
    }
    .upload-icon-wrap svg { color: var(--blue-400); }

    .upload-title {
        font-family: 'Syne', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.4rem;
    }
    .upload-subtitle {
        color: var(--muted);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }
    .upload-subtitle span { color: var(--blue-400); font-weight: 500; }

    .format-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .format-pdf {
        background: rgba(239, 68, 68, 0.1);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    #realFileInput { display: none; }

    /* ── Title input (new, same style as layout form controls) ── */
    .title-field-wrap {
        margin-bottom: 1.5rem;
    }
    .title-label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: var(--blue-300);
        margin-bottom: 0.5rem;
    }
    .title-label svg { opacity: 0.75; }
    .title-input {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border);
        color: var(--white);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .title-input::placeholder { color: var(--muted); }
    .title-input:focus {
        border-color: rgba(55,138,221,0.5);
        background: rgba(55,138,221,0.05);
        box-shadow: 0 0 0 3px rgba(55,138,221,0.1);
    }
    .title-input.is-invalid {
        border-color: rgba(239,68,68,0.5);
        background: rgba(239,68,68,0.04);
    }
    .field-error {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        margin-top: 0.45rem;
        font-size: 0.78rem;
        color: #f87171;
    }

    /* ── Upload button ── */
    .btn-upload {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1.5rem;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        border: 1px solid rgba(55, 138, 221, 0.35);
        color: white;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        box-shadow: 0 6px 20px rgba(24, 95, 165, 0.35);
    }
    .btn-upload:hover {
        background: linear-gradient(135deg, var(--blue-500), var(--blue-600));
        box-shadow: 0 10px 28px rgba(24, 95, 165, 0.5);
        transform: translateY(-1px);
    }
    .btn-upload:active { transform: translateY(0); }
    .btn-upload:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

    /* ── File info bar ── */
    .file-info-bar {
        display: none;
        align-items: center;
        gap: 1rem;
        padding: 0.9rem 1.25rem;
        background: rgba(55, 138, 221, 0.07);
        border: 1px solid rgba(55, 138, 221, 0.2);
        border-radius: 14px;
        margin-top: 1.5rem;
        animation: fadeUp 0.4s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .file-info-bar.visible { display: flex; }

    .file-icon-box {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        background: rgba(239,68,68,0.12);
        border: 1px solid rgba(239,68,68,0.2);
        color: #f87171;
    }
    .file-meta { flex: 1; min-width: 0; }
    .file-name {
        font-size: 0.9rem; font-weight: 600; color: var(--white);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .file-size { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }

    .file-actions { display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0; }
    .btn-change {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.45rem 0.9rem; border-radius: 9px;
        background: rgba(55,138,221,0.12); border: 1px solid rgba(55,138,221,0.25);
        color: var(--blue-300); font-size: 0.8rem; font-weight: 600; cursor: pointer;
        transition: background 0.2s, border-color 0.2s;
    }
    .btn-change:hover { background: rgba(55,138,221,0.2); border-color: rgba(55,138,221,0.4); }
    .btn-remove {
        display: inline-flex; align-items: center; justify-content: center;
        width: 34px; height: 34px; border-radius: 9px;
        background: rgba(248,113,113,0.08); border: 1px solid rgba(248,113,113,0.18);
        color: #f87171; cursor: pointer; transition: background 0.2s, border-color 0.2s;
    }
    .btn-remove:hover { background: rgba(248,113,113,0.18); border-color: rgba(248,113,113,0.35); }

    /* ── Submit row ── */
    .submit-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.75rem;
        flex-wrap: wrap;
    }
    .submit-note {
        font-size: 0.78rem;
        color: var(--muted);
    }
    .submit-note span { color: var(--blue-300); font-weight: 500; }

    /* ── No-preview hint ── */
    .no-preview-hint {
        margin-top: 1.75rem;
        padding: 1.5rem;
        border-radius: 14px;
        background: rgba(55, 138, 221, 0.04);
        border: 1px dashed rgba(55, 138, 221, 0.15);
        text-align: center;
        color: rgba(156, 163, 175, 0.6);
        font-size: 0.82rem;
    }
    .no-preview-hint svg {
        display: block; margin: 0 auto 0.5rem; opacity: 0.3;
    }

    /* ── Preview section ── */
    .preview-section {
        display: none;
        margin-top: 2rem;
        animation: fadeUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .preview-section.visible { display: block; }
    .preview-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem; flex-wrap: wrap; gap: 0.75rem;
    }
    .preview-label {
        display: flex; align-items: center; gap: 0.5rem;
        font-family: 'Syne', sans-serif; font-size: 0.95rem;
        font-weight: 700; color: var(--white);
    }
    .preview-label svg { color: var(--blue-400); }
    .preview-wrapper {
        border-radius: 18px; border: 1px solid var(--border);
        overflow: hidden; background: rgba(255,255,255,0.02);
        box-shadow: 0 20px 60px rgba(1,26,56,0.5);
    }
    .pdf-frame {
        width: 100%; height: 75vh; min-height: 500px;
        border: none; display: block;
    }

    /* ── Upload card wrapper ── */
    .upload-card { padding: 1.75rem; }

    /* ── Responsive ── */
    @media (max-width: 600px) {
        .upload-zone { padding: 2rem 1.25rem; }
        .pdf-frame { height: 55vh; min-height: 350px; }
        .btn-change span { display: none; }
    }

    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')

{{-- ── Flash messages ─────────────────────────────────────────────────────── --}}
@if (session('success'))
    <div class="alert alert-success anim">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if ($errors->any() && ! $errors->has('title') && ! $errors->has('file'))
    <div class="alert alert-error anim">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        Something went wrong. Please check the form and try again.
    </div>
@endif

{{-- ── Page Header ────────────────────────────────────────────────────────── --}}
<div class="page-header anim">
    <h1>Emploi du Temps</h1>
    <p>Upload your school schedule as a PDF file — max 2 MB.</p>
</div>

{{-- ── Upload Form Card ────────────────────────────────────────────────────── --}}
<div class="card upload-card anim anim-d1">

    {{--
        enctype="multipart/form-data" is required for file uploads.
        The form POSTs to the named route `schedules.upload`.
    --}}
    <form
        id="uploadForm"
        method="POST"
        action="{{ route('schedules.upload') }}"
        enctype="multipart/form-data"
        novalidate
    >
        @csrf

        {{-- ── Title field ─────────────────────────────────────────────────── --}}
        <div class="title-field-wrap">
            <label class="title-label" for="title">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <line x1="21" y1="6" x2="3" y2="6"/>
                    <line x1="15" y1="12" x2="3" y2="12"/>
                    <line x1="17" y1="18" x2="3" y2="18"/>
                </svg>
                Schedule Title
            </label>
            <input
                type="text"
                id="title"
                name="title"
                class="title-input @error('title') is-invalid @enderror"
                placeholder="e.g. Winter Semester 2025 — Week 12"
                value="{{ old('title') }}"
                autocomplete="off"
                required
            >
            @error('title')
                <div class="field-error">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- ── Drop zone (PDF only — file field named "file") ──────────────── --}}
        <div
            class="upload-zone @error('file') drag-over @enderror"
            id="dropZone"
            onclick="document.getElementById('realFileInput').click()"
        >
            <div class="upload-icon-wrap">
                <svg width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
            </div>

            <div class="upload-title">Drop your PDF here</div>
            <div class="upload-subtitle">
                Drag &amp; drop, or <span>click to browse</span>
            </div>

            <span class="format-tag format-pdf" style="margin-bottom:1.25rem;display:inline-flex;">
                <svg width="11" height="11" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                </svg>
                PDF only · max 2 MB
            </span>

            {{--
                The real file input — hidden, name="file".
                Laravel validates and reads it via $request->file('file').
            --}}
            <input
                type="file"
                id="realFileInput"
                name="file"
                accept=".pdf,application/pdf"
            >
        </div>

        @error('file')
            <div class="field-error" style="margin-top:0.5rem;">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ $message }}
            </div>
        @enderror

        {{-- ── File info bar (shown by JS after a file is picked) ───────────── --}}
        <div class="file-info-bar" id="fileInfoBar">
            <div class="file-icon-box">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <div class="file-meta">
                <div class="file-name" id="chosenFileName">–</div>
                <div class="file-size" id="chosenFileSize">–</div>
            </div>
            <div class="file-actions">
                <button
                    type="button"
                    class="btn-change"
                    onclick="document.getElementById('realFileInput').click()"
                >
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    <span>Change</span>
                </button>
                <button type="button" class="btn-remove" id="removeFileBtn" title="Remove">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- ── Hint shown before file is chosen ─────────────────────────────── --}}
        <div class="no-preview-hint" id="noPreviewHint">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            Your PDF preview will appear here once you select a file.
        </div>

        {{-- ── Submit row ───────────────────────────────────────────────────── --}}
        <div class="submit-row">
            <button type="submit" class="btn-upload" id="submitBtn">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Upload Schedule
            </button>
            <span class="submit-note">
                Stored in <span>storage/app/public/schedules/</span>
            </span>
        </div>

    </form>
</div>

{{-- ── Client-side PDF preview (before the form submits) ──────────────────── --}}
<div class="preview-section" id="previewSection">
    <div class="preview-header">
        <div class="preview-label">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            Preview
        </div>
        <span class="format-tag format-pdf">PDF Document</span>
    </div>
    <div class="preview-wrapper">
        <iframe id="pdfFrame" class="pdf-frame" title="PDF preview"></iframe>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /* ── Element refs ──────────────────────────────────────────────────────── */
    const dropZone      = document.getElementById('dropZone');
    const fileInput     = document.getElementById('realFileInput');
    const fileInfoBar   = document.getElementById('fileInfoBar');
    const chosenName    = document.getElementById('chosenFileName');
    const chosenSize    = document.getElementById('chosenFileSize');
    const noHint        = document.getElementById('noPreviewHint');
    const previewSec    = document.getElementById('previewSection');
    const pdfFrame      = document.getElementById('pdfFrame');
    const removeBtn     = document.getElementById('removeFileBtn');
    const submitBtn     = document.getElementById('submitBtn');
    let   objectUrl     = null; // track blob URL to revoke later

    /* ── Drag & Drop ───────────────────────────────────────────────────────── */
    ['dragenter', 'dragover'].forEach(evt =>
        dropZone.addEventListener(evt, e => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        })
    );
    ['dragleave', 'drop'].forEach(evt =>
        dropZone.addEventListener(evt, e => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
        })
    );
    dropZone.addEventListener('drop', e => {
        const file = e.dataTransfer.files[0];
        if (file) attachFile(file);
    });

    /* ── File input change ─────────────────────────────────────────────────── */
    fileInput.addEventListener('change', () => {
        if (fileInput.files[0]) attachFile(fileInput.files[0]);
    });

    /* ── Remove button ─────────────────────────────────────────────────────── */
    removeBtn.addEventListener('click', clearFile);

    /* ── Helpers ───────────────────────────────────────────────────────────── */
    function formatBytes(bytes) {
        if (bytes < 1024)    return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    /**
     * Called when a valid file is selected (via input or drag-drop).
     * Updates the info bar and renders the PDF preview in the iframe.
     */
    function attachFile(file) {
        if (file.type !== 'application/pdf') {
            alert('Only PDF files are accepted.');
            return;
        }

        // Revoke previous blob URL to free memory
        if (objectUrl) URL.revokeObjectURL(objectUrl);
        objectUrl = URL.createObjectURL(file);

        // Info bar
        chosenName.textContent = file.name;
        chosenSize.textContent = formatBytes(file.size);
        fileInfoBar.classList.add('visible');
        noHint.style.display = 'none';

        // Inline preview
        pdfFrame.src = objectUrl;
        previewSec.classList.add('visible');
        setTimeout(() => previewSec.scrollIntoView({ behavior: 'smooth', block: 'start' }), 120);
    }

    /**
     * Reset everything — removes preview and clears the hidden file input
     * so the same file can be re-selected if needed.
     */
    function clearFile() {
        fileInput.value = '';
        if (objectUrl) { URL.revokeObjectURL(objectUrl); objectUrl = null; }
        pdfFrame.src = '';
        fileInfoBar.classList.remove('visible');
        previewSec.classList.remove('visible');
        noHint.style.display = '';
    }

    /* ── Submitting state ──────────────────────────────────────────────────── */
    document.getElementById('uploadForm').addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5"
                 style="animation:spin 0.8s linear infinite">
                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
            </svg>
            Uploading…
        `;
    });
</script>
@endpush