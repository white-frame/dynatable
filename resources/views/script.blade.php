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
        $('#{!! $dynatable->getTableId() !!}').dynatable(dynatableOptions_{!! $dynatable->getSlug() !!})
                .on('dynatable:afterUpdate', function () {
                    handleDynamicDom($('#{!! $dynatable->getTableId() !!}'));
                });

        var dynatableToolbar = '{!! $dynatable->getContainerId() !!}';

        $(dynatableToolbar).find('input').on('keydown', function (ev) {
            if (ev.which === 13) {
                dynatableRefreshSearchFields('{!! $dynatable->getTableId() !!}', {!! json_encode($dynatable->getSearches()) !!});
                return false;
            }
        });

        $(dynatableToolbar).find('select').each(function(index) {
            $(this).on("change", function (e) {
                dynatableRefreshSearchFields('{!! $dynatable->getTableId() !!}', {!! json_encode($dynatable->getSearches()) !!});
            });
        });

        $(dynatableToolbar).find('.dynatable-action-export').click(function() {
            dynatableDownloadResults('{!! $dynatable->getTableId() !!}', $(this).attr('data-format'));
        });
    });
</script>