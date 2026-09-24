@php $task = $task ?? null; @endphp

<div class="form-group">
    <label for="title">Název úkolu</label>
    <input type="text" id="title" name="title" value="{{ old('title', $task?->title) }}" required autofocus>
</div>

<div class="form-group">
    <label for="description">Popis</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $task?->description) }}</textarea>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="status">Stav</label>
        <select id="status" name="status">
            @foreach (['nezahájeno', 'probíhá', 'hotovo'] as $status)
                <option value="{{ $status }}" @selected(old('status', $task?->status) === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="priority">Priorita</label>
        <select id="priority" name="priority">
            @foreach (['nízká', 'střední', 'vysoká'] as $priority)
                <option value="{{ $priority }}" @selected(old('priority', $task?->priority) === $priority)>{{ ucfirst($priority) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="due_date">Termín</label>
        <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task?->due_date?->format('Y-m-d')) }}">
    </div>
    <div class="form-group">
        <label for="student_id">Přiřadit studentovi</label>
        <select id="student_id" name="student_id">
            <option value="">— Nepřiřazeno —</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $task?->student_id) == $student->id)>
                    {{ $student->last_name }} {{ $student->first_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
