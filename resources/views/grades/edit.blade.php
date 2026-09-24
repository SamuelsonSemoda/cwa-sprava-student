@extends('layouts.app')

@section('title', 'Upravit známku')

@section('content')
    <div class="form-card">
        <form action="{{ route('grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')
            @include('grades._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Uložit změny</button>
                <a href="{{ route('grades.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
