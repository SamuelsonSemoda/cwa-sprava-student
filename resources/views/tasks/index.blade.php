@extends('layouts.app')

@section('title', 'Správa úkolů')

@section('content')
    <div class="toolbar">
        <form method="GET" class="toolbar-filters">
            <input type="text" name="search" class="search-input" placeholder="Hledat úkol…" value="{{ request('search') }}">
            <select name="status" class="select-input" onchange="this.form.submit()">
                <option value="">Všechny stavy</option>
                <option value="nezahájeno" @selected(request('status') === 'nezahájeno')>Nezahájeno</option>
                <option value="probíhá" @selected(request('status') === 'probíhá')>Probíhá</option>
                <option value="hotovo" @selected(request('status') === 'hotovo')>Hotovo</option>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm">Filtrovat</button>
        </form>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Nový úkol</a>
    </div>

    <div class="card">
        @if ($tasks->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">✓</div>
                <p>Zatím nemáte žádné úkoly.</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Název</th>
                        <th>Student</th>
                        <th>Priorita</th>
                        <th>Stav</th>
                        <th>Termín</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>
                                <strong>{{ $task->title }}</strong>
                                @if ($task->description)
                                    <div style="color:var(--text-muted); font-size:0.82rem; margin-top:2px;">
                                        {{ \Illuminate\Support\Str::limit($task->description, 60) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $task->student?->full_name ?? '—' }}</td>
                            <td><span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                            <td><span class="badge badge-{{ $task->status }}">{{ ucfirst($task->status) }}</span></td>
                            <td>{{ $task->due_date?->format('d.m.Y') ?? '—' }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Upravit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Opravdu smazat tento úkol?');">
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
        {{ $tasks->links() }}
    </div>
@endsection
