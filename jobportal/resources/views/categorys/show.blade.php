<x-app-layout>
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h1 class="card-title">{{ $category->name }}</h1>
            </div>
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Zurück zur Übersicht</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Positionen in dieser Kategorie:</h2>
            </div>
            <div class="card-body">
                @if ($positions->isEmpty())
                    <p>Keine Positionen für diese Kategorie gefunden.</p>
                @else
                    <ul class="list-group">
                        @foreach ($positions as $position)
                            <li class="list-group-item">
                                <a href="{{ route('positions.show', $position->id) }}">
                                    <strong>{{ $position->title }}</strong>
                                    <span class="text-muted"> – {{ $position->location }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
