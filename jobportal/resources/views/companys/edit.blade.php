<x-app-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Firma bearbeiten</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('companys.update', $company->id) }}" method="POST">
                    <!-- Create CSRF-Token -->
                    @csrf
                    <!-- Ensure the use of PUT, method spoofing -->
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value={{ $company->name }} required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Beschreibung</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required> {{ $company->description }} </textarea>
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

