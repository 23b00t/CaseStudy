<x-app-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">{{ $position->title }}</h1>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Beschreibung:</strong> {{ $position->description }}</p>
                <p class="card-text"><strong>Ort:</strong> {{ $position->location }}</p>
                <p class="card-text"><strong>Gehalt:</strong> {{ $position->salary }}</p>
                <p class="card-text"><strong>Firma:</strong> {{ $position->company->name }}</p>
                <p class="card-text"><strong>Kategorie:</strong>  {{ $position->category->name ?? 'Keine Kategorie zugewiesen' }}</p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Zurück zur Übersicht</a>
            </div>
        </div>
    </div>
</x-app-layout>
