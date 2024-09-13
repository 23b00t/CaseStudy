<x-app-layout>
    <h1>Alle Kategorien</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
        @foreach($allCategorys as $key => $value)
            <tr>
                <td>{{ $value->name }}</td>

                <td>
                    <form action="{{ url('categorys/' . $value->id) }}" method="POST" class="pull-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Kategorie löschen</button>
                    </form>

                    <a class="btn btn-small btn-success" href="{{ url('categorys/' . $value->id) }}">Kategorie anzeigen</a>

                    <a class="btn btn-small btn-info" href="{{ url('categorys/' . $value->id . '/edit') }}">Kategorie bearbeiten</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>

