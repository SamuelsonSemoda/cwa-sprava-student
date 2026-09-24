@extends('layouts.app')

@section('title', 'Nový úkol')

@section('content')
    <div class="form-card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            @include('tasks._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Vytvořit úkol</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
