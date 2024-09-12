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
                <form action="{{ url('positions/' . $value->id) }}" method="POST" class="pull-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning">Jobangebot löschen</button>
                </form>

                <a class="btn btn-small btn-success" href="{{ url('positions/' . $value->id) }}">Angebot anzeigen</a>

                <a class="btn btn-small btn-info" href="{{ url('positions/' . $value->id . '/edit') }}">Angebot bearbeiten</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
