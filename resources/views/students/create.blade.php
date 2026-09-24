@extends('layouts.app')

@section('title', 'Přidat studenta')

@section('content')
    <div class="form-card">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            @include('students._form')
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Přidat studenta</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
@endsection
