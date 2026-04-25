@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Mijn contacten</div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">
                Add new contact
            </a>

            @if ($contacts->count())
                <ul class="list-group">
                    @foreach ($contacts as $contact)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $contact->first_name }} {{ $contact->last_name }}</strong><br>
                                {{ $contact->email }}<br>
                                {{ $contact->phone }}<br>
                                {{ $contact->address }}
                            </div>

                            <div>
                                <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3">
                    {{ $contacts->links() }}
                </div>
            @else
                <p>Je hebt nog geen contacten.</p>
            @endif
              @if ($deletedContacts->count())
                <div class="mt-4">
                    <h3>Verwijderde contacten</h3>

                    <ul class="list-group">
                        @foreach ($deletedContacts as $contact)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    {{ $contact->first_name }} {{ $contact->last_name }} - {{ $contact->email }}
                                </div>

                                <div class="d-flex gap-2">
                                <form action="{{ route('contacts.restore', $contact->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Restore
                                    </button>
                                </form>

                                <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete permanently
                                    </button>
                                </form>
                            </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection