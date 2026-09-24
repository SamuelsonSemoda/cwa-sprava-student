@extends('layouts.app')

@section('title', 'Detail studenta')

@section('content')
    <div class="form-card" style="margin-bottom:24px;">
        <h2 style="margin-top:0;">{{ $student->last_name }} {{ $student->first_name }}</h2>
        <p style="color:var(--text-muted);">
            {{ $student->email }} &nbsp;·&nbsp; {{ $student->class ?? 'Bez třídy' }} &nbsp;·&nbsp; {{ $student->phone ?? 'Bez telefonu' }}
        </p>
        @if ($student->note)
            <p>{{ $student->note }}</p>
        @endif
        <div class="row-actions">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm">Upravit</a>
            <a href="{{ route('grades.create') }}" class="btn btn-secondary btn-sm">+ Zapsat známku</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Zpět na seznam</a>
        </div>
    </div>

    <div class="stat-row">
        <div class="stat-box">
            <div class="stat-label">Počet úkolů</div>
            <div class="stat-value">{{ $student->tasks->count() }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Počet známek</div>
            <div class="stat-value">{{ $student->grades->count() }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Průměr známek</div>
            <div class="stat-value">{{ $student->average_grade ?? '—' }}</div>
        </div>
    </div>

    <h3>Známky</h3>
    <div class="card" style="margin-bottom:32px;">
        @if ($student->grades->isEmpty())
            <div class="empty-state">
                <p>Tento student zatím nemá žádné známky.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Předmět</th>
                        <th>Známka</th>
                        <th>Úkol</th>
                        <th>Datum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->grades->sortByDesc('date') as $grade)
                        <tr>
                            <td>{{ $grade->subject }}</td>
                            <td><span class="badge badge-grade-{{ $grade->value }}">{{ $grade->value }} · {{ $grade->label }}</span></td>
                            <td>{{ $grade->task?->title ?? '—' }}</td>
                            <td>{{ $grade->date->format('d.m.Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <h3>Přiřazené úkoly</h3>
    <div class="card">
        @if ($student->tasks->isEmpty())
            <div class="empty-state">
                <p>Tento student zatím nemá žádné úkoly.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Název</th>
                        <th>Priorita</th>
                        <th>Stav</th>
                        <th>Termín</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td><span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                            <td><span class="badge badge-{{ $task->status }}">{{ ucfirst($task->status) }}</span></td>
                            <td>{{ $task->due_date?->format('d.m.Y') ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
