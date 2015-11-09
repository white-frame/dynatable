<script type="text/javascript">
    var dynatableOptions_{!! $dynatable->getSlug() !!} = {
        dataset: {
            ajax: true,
            ajaxUrl: '{!! $dynatable->getEndpoint() !!}{!! isset($options['endpoint-params']) ? '?' . http_build_query($options['endpoint-params']): '' !!}',
            ajaxOnLoad: true,
            records: [],
            sorts: {!! json_encode($options['sorts']) !!},
            perPageDefault: {!! isset($options['perPageDefault']) ? $options['perPageDefault'] : 50 !!}
        },
        features: {
            sort: true,
            search: false
        }
    };

    $(document).ready(function () {
        $('#{!! $dynatable->getTableId() !!}')
                .dynatable(dynatableOptions_{!! $dynatable->getSlug() !!})
                .on('dynatable:afterUpdate', function () {
                    $.jwf('dom').handle($('#{!! $dynatable->getTableId() !!}'))
                });
    });
</script>