<x-app-layout>
    <h1>Aktuelle Stellenausschreibungen</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Titel</td>
                <td>Ort</td>
            </tr>
        </thead>
        <tbody>
        @foreach($allPositions as $key => $value)
            <tr>
                <td>{{ $value->title }}</td>
                <td>{{ $value->location }}</td>

                <td>
                    <!-- Check if the user is allowed to delete position; otherwise don't show the link -->
                    @can('delete', $value)
                        <form action="{{ url('positions/' . $value->id) }}" method="POST" class="pull-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">Jobangebot löschen</button>
                        </form>
                    @endcan

                    <a class="btn btn-small btn-success" href="{{ url('positions/' . $value->id) }}">Angebot anzeigen</a>

                    <!-- Check if the user is allowed to edit position; otherwise don't show the link -->
                    @can('update', $value)
                        <a class="btn btn-small btn-info" href="{{ url('positions/' . $value->id . '/edit') }}">Angebot bearbeiten</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>

