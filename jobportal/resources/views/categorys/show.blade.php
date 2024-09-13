<x-app-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">{{ $category->name }}</h1>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Zurück zur Übersicht</a>
            </div>
        </div>
    </div>
</x-app-layout>
