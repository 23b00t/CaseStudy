<x-app-layout>
    <h1>Alle Firmen</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
        @foreach($allCompanys as $key => $value)
            <tr>
                <td>{{ $value->name }}</td>

                <td>
                    <form action="{{ url('companys/' . $value->id) }}" method="POST" class="pull-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-warning">Firma löschen</button>
                    </form>

                    <a class="btn btn-small btn-success" href="{{ url('companys/' . $value->id) }}">Firma anzeigen</a>

                    <a class="btn btn-small btn-info" href="{{ url('companys/' . $value->id . '/edit') }}">Firma bearbeiten</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>

