@php $grade = $grade ?? null; @endphp

<div class="form-row">
    <div class="form-group">
        <label for="student_id">Student</label>
        <select id="student_id" name="student_id" required>
            <option value="">— Vyberte studenta —</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id', $grade?->student_id) == $student->id)>
                    {{ $student->last_name }} {{ $student->first_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="subject">Předmět</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject', $grade?->subject) }}" placeholder="např. Matematika" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="value">Známka</label>
        <select id="value" name="value" required>
            @foreach (\App\Models\Grade::labels() as $num => $label)
                <option value="{{ $num }}" @selected(old('value', $grade?->value) == $num)>{{ $num }} — {{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date">Datum</label>
        <input type="date" id="date" name="date" value="{{ old('date', $grade?->date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="task_id">Přiřadit k úkolu <span style="color:var(--text-muted); font-weight:400;">(volitelné)</span></label>
    <select id="task_id" name="task_id">
        <option value="">— Bez vazby na úkol —</option>
        @foreach ($tasks as $task)
            <option value="{{ $task->id }}" @selected(old('task_id', $grade?->task_id) == $task->id)>
                {{ $task->title }} @if ($task->student) ({{ $task->student->last_name }} {{ $task->student->first_name }}) @endif
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="note">Poznámka</label>
    <textarea id="note" name="note" rows="3">{{ old('note', $grade?->note) }}</textarea>
</div>
