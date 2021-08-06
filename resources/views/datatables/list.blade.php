<!DOCTYPE html>
<html lang="en">
<head>
    <title>Datatables</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Laravel Datatables</h2>
        <div class="table-responsive">
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <label for="">From Date</label>
                    <input type="date" id="from_date" value="" >
                </div>

                <div class="col-md-3">
                    <label for="">To Date</label>
                    <input type="date" id="to_date" value="" >
                </div>

                <div class="col-md-3">
                    <button type="button" class="btn btn-info" onclick="reload_table()" >Filter</button>
                </div>
            </div>
            <hr>

            <table id="posts-table" class="table table-bordered">
                <thead>

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(function() {
            var drawer_count = 1;

            $('#posts-table').DataTable({
                "oLanguage": {
                    "sProcessing": '<span>Please wait ...</span>'
                },
                "pagingType": "simple_numbers",
                "paging": true,
                "lengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "type": "GET",
                    "url": "{{ url('datatables/posts') }}",
                    "data": function(d) {
                        d.from_date = document.getElementById('from_date').value;
                        d.to_date = document.getElementById('to_date').value;
                    },
                    "dataFilter": function(data) {
                        drawer_count++;
                        var json = jQuery.parseJSON(data);
                        json.draw = json.draw;
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        json.data = json.data;

                        $('#list_table_processing').css('display', 'none');
                        return JSON.stringify(json); // return JSON string
                    }
                },
                "columns": [
                    {"title": "#", "data": "sl_no", "name": "sl_no", "visible": true, "searchable": true},
                    {"title": "Title", "data": "name", "name": "name", "visible": true, "searchable": true},
                    {"title": "Slug", "data": "slug", "name": "slug", "visible": true, "searchable": true},
                    {"title": "Description", "data": "description", "name": "description", "visible": true, "searchable": true},
                ],
            });
        });

        function reload_table() {
            $('#posts-table').DataTable().ajax.reload();
        }
    </script>

</body>
</html>