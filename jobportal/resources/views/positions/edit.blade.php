<x-app-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Job Beschreibung bearbeiten</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('positions.update', $position->id) }}" method="POST">
                    <!-- Create CSRF-Token -->
                    @csrf
                    <!-- Ensure the use of PUT, method spoofing -->
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" value={{ $position->title }} required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Beschreibung</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required> {{ $position->description }} </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Ort</label>
                        <input type="text" class="form-control" id="location" name="location" value={{ $position->location }} required>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Gehalt</label>
                        <input type="number" class="form-control" id="salary" name="salary" value={{ $position->salary }} >
                    </div>
            </div>

                    <button type="submit" class="btn btn-primary">Speichern</button>
                </form>

                <!-- Show errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

