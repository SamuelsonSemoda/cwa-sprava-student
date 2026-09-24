@extends('layouts.app')

@section('title', 'Upravit studenta')

@section('content')
    <div class="form-card">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            @include('students._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Uložit změny</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
