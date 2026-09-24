@extends('layouts.app')

@section('title', 'Upravit úkol')

@section('content')
    <div class="form-card">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            @include('tasks._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Uložit změny</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
