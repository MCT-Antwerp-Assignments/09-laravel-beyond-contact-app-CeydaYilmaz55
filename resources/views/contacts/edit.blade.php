@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact bewerken</h1>

    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">Voornaam</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $contact->first_name }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Achternaam</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $contact->last_name }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefoon</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adres</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}">
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection