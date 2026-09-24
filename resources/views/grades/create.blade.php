@extends('layouts.app')

@section('title', 'Zapsat známku')

@section('content')
    <div class="form-card">
        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            @include('grades._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Zapsat známku</button>
                <a href="{{ route('grades.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
