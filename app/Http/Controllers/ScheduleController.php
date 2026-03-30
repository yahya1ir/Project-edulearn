<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\presence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Show the upload form.
     */
    public function index(): View
    {
        $students = presence::all();
        return view('schedule', compact('students'));
    }

    /**
     * Handle the PDF upload, persist the record, and redirect.
     *
     * Validation rules:
     *   - title : required string, max 255 chars
     *   - file  : required PDF, max 2 MB (2048 KB)
     *
     * Storage:
     *   - Disk   : public  → storage/app/public/
     *   - Folder : schedules/
     *   - Name   : {uuid}.pdf  (unique, collision-proof)
     *
     * Only the relative path is saved in the database.
     * The full URL is resolved via Storage::url() in the model accessor.
     */
    public function upload(Request $request): RedirectResponse
    {
        // ── 1. Validate ────────────────────────────────────────────────────────
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'file'  => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ], [
            'file.mimes' => 'Only PDF files are accepted.',
            'file.max'   => 'The PDF must not exceed 2 MB.',
        ]);

        // ── 2. Generate a unique file name and store the file ──────────────────
        $uniqueName = Str::uuid() . '.pdf';

        // putFileAs returns the stored path relative to the disk root,
        // e.g. "schedules/550e8400-e29b-41d4-a716-446655440000.pdf"
        $path = $request->file('file')->storeAs(
            'schedules',   // folder inside storage/app/public/
            $uniqueName,
            'public'       // disk
        );

        // ── 3. Persist only the path in the database ───────────────────────────
        Schedule::create([
            'title'     => $validated['title'],
            'file_path' => $path,
        ]);

        // ── 4. Redirect with success flash ─────────────────────────────────────
        return redirect()
            ->route('schedules.index')
            ->with('success', 'Schedule "' . $validated['title'] . '" uploaded successfully.');
    }
}