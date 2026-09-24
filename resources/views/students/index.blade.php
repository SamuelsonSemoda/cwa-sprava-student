@extends('layouts.app')

@section('title', 'Evidence studentů')

@section('content')
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <input type="text" name="search" class="search-input" placeholder="Hledat studenta…" value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary btn-sm">Hledat</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Přidat studenta</a>
    </div>

    <div class="card">
        @if ($students->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🎓</div>
                <p>Zatím nemáte žádné studenty.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>E-mail</th>
                        <th>Třída</th>
                        <th>Telefon</th>
                        <th>Úkoly</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td><strong>{{ $student->last_name }} {{ $student->first_name }}</strong></td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->class ?? '—' }}</td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td><span class="badge badge-nízká">{{ $student->tasks_count }}</span></td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm">Upravit</a>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Opravdu smazat tohoto studenta?');">
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
        {{ $students->links() }}
    </div>
@endsection
