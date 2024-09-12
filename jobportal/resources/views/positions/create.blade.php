<x-app-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Stelle einen neuen Job ein</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Beschreibung</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required> </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Ort</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Gehalt</label>
                        <input type="number" class="form-control" id="salary" name="salary" >
                    </div>
            </div>

                    <button type="submit" class="btn btn-primary">Speichern</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

