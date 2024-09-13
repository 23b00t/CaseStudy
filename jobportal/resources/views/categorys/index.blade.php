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
                    <!-- Check if the user is allowed to delete categories; otherwise don't show the link -->
                    @can('delete', $value)
                        <form action="{{ url('categorys/' . $value->id) }}" method="POST" class="pull-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">Kategorie löschen</button>
                        </form>
                    @endcan

                    <a class="btn btn-small btn-success" href="{{ url('categorys/' . $value->id) }}">Kategorie anzeigen</a>

                    <!-- Check if the user is allowed to edit categories; otherwise don't show the link -->
                    @can('update', $value)
                        <a class="btn btn-small btn-info" href="{{ url('categorys/' . $value->id . '/edit') }}">Kategorie bearbeiten</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>

