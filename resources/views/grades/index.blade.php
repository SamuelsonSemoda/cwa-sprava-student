@extends('layouts.app')

@section('title', 'Známkování')

@section('content')
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <select name="student_id" class="select-input" onchange="this.form.submit()">
                <option value="">Všichni studenti</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" @selected(request('student_id') == $student->id)>
                        {{ $student->last_name }} {{ $student->first_name }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="subject" class="search-input" placeholder="Hledat předmět…" value="{{ request('subject') }}">
            <button type="submit" class="btn btn-secondary btn-sm">Filtrovat</button>
        </form>
        <a href="{{ route('grades.create') }}" class="btn btn-primary">+ Zapsat známku</a>
    </div>

    <div class="card">
        @if ($grades->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">★</div>
                <p>Zatím nejsou zapsané žádné známky.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Předmět</th>
                        <th>Známka</th>
                        <th>Úkol</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td><strong>{{ $grade->student->last_name }} {{ $grade->student->first_name }}</strong></td>
                            <td>{{ $grade->subject }}</td>
                            <td><span class="badge badge-grade-{{ $grade->value }}">{{ $grade->value }} · {{ $grade->label }}</span></td>
                            <td>
                                @if ($grade->task)
                                    <span class="badge badge-nízká">{{ \Illuminate\Support\Str::limit($grade->task->title, 30) }}</span>
                                @else
                                    <span style="color:var(--text-muted);">—</span>
                                @endif
                            </td>
                            <td>{{ $grade->date->format('d.m.Y') }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-secondary btn-sm">Upravit</a>
                                    <form action="{{ route('grades.destroy', $grade) }}" method="POST" onsubmit="return confirm('Opravdu smazat tuto známku?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Smazat</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="pagination-wrap">
        {{ $grades->links() }}
    </div>
@endsection
