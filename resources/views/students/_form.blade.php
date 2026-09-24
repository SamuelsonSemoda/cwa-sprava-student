@php $student = $student ?? null; @endphp

<div class="form-row">
    <div class="form-group">
        <label for="first_name">Jméno</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $student?->first_name) }}" required autofocus>
    </div>
    <div class="form-group">
        <label for="last_name">Příjmení</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $student?->last_name) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="{{ old('email', $student?->email) }}" required>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="class">Třída / ročník</label>
        <input type="text" id="class" name="class" value="{{ old('class', $student?->class) }}" placeholder="např. 3.A">
    </div>
    <div class="form-group">
        <label for="birth_date">Datum narození</label>
        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $student?->birth_date?->format('Y-m-d')) }}">
    </div>
</div>

<div class="form-group">
    <label for="phone">Telefon</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $student?->phone) }}">
</div>

<div class="form-group">
    <label for="note">Poznámka</label>
    <textarea id="note" name="note" rows="3">{{ old('note', $student?->note) }}</textarea>
</div>
