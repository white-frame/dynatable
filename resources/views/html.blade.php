<div id="{!! $dynatable->getContainerId() !!}">
    <div class="row dynatable-toolbar">
        <div class="col-md-8">
            <div class="dynatable-searches">
                <div class="dynatable-title"><i class="fa fa-filter"></i>
                    Filtrage des resultats</div>

                <div class="dynatable-content">
                    @foreach($dynatable->getSearches() as $name => $type)
                        @if(isset($dynatable->getTableColumns()[$name]))
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon" style="text-align: right;">{{ $dynatable->getTableColumns()[$name] }} :</span>

                                    @if($type == 'string')
                                        <input class="form-control dynatable-field-{{ $name }}" name="{{ $name }}" style="height: 28px;" type="text">
                                    @elseif($type == 'date')
                                        <input class="form-control dynatable-field-{{ $name }}" name="{{ $name }}" style="height: 28px;" type="text">
                                    @elseif(is_array($type))
                                        <select name="{{ $name }}" class="form-control dynatable-field-{{ $name }}">
                                            <option></option>
                                            @foreach($type as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dynatable-searches">
                <div class="dynatable-title"><i class="fa fa-table"></i>
                    Données et exportation</div>

                <div class="dynatable-content">
                    <button class="dynatable-action-export btn btn-default" data-format="xls"><i class="fa fa-file-excel-o"></i>
                        Exporter en excel</button>
                    <button class="dynatable-action-export btn btn-default" data-format="csv"><i class="fa fa-file-text-o"></i>
                        Exporter en CSV</button>
                </div>
            </div>
        </div>
    </div>

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