<table class="table table-flush table-striped table-hover" id="sites-menu-table">
    <thead class="thead-light">
    <tr>
        <th>Titulo</th>
        <th>Url</th>
        <th></th>
    </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $(document).ready(function ($) {
            $('#sites-menus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.sites.menus.datatables') }}',
                keys: !0,
                select: {
                    style: "multi"
                },
                lengthChange: !1,
                dom: "Bfrtip",
                buttons: ["copy", "print"],
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                columns: [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'route',
                        name: 'route'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $("div.dataTables_length select").removeClass("custom-select custom-select-sm");
            $(".dt-buttons .btn").removeClass("btn-secondary").addClass("btn-sm btn-default");
        });
    </script>
@endpush
