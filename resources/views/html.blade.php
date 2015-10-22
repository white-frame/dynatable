<div id="{!! $dynatable->getContainerId() !!}">
    <table class="table table-bordered table-hover table-striped" id="{{ $dynatable->getTableId() }}">
        <thead>
        <tr>
            @foreach($dynatable->getColumns() as $id => $name)
                <th data-dynatable-column="{{ $id }}">
                    {{ $name  }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>