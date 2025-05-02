@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Projects</h4>
                </div>
                <div class="database-btn">                 
  
                    <a href="{{url('admin/projects/create')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-success"><i class="fa fa-plus"></i> Add Project</a></br></br>
                </div>
            </div>
       

            @include('layouts.partials.messages')

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="projectsTable" class="display">
                        <thead>
                        <tr>
                            <th></th>                            
                            <th>Title</th>                            
                            <th>Progress</th>                             
                            <th>Added At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                       
                    </table>
                </div>
                

            </div>
        </div>
    </div>

    

   <script>


function renderActionColumn(id){

    return '<a class="btn btn-sm btn-primary" href="'+window.cmax.adminUrl+'/properties/'+id+'/edit" class="btn-sm btn-success action-button">Edit</a><a type="button" href="#" class="delete-rec btn btn-sm btn-danger" data-route="/admin/properties/'+id+'" data-tableid="projectsTable"   data-id="'+id+'">Delete</a>';
}



        $(document).ready(function () {

             function format(d) {
                if (!d.properties.length) return '<em>No properties assigned.</em>';

                let rows = d.properties.map(prop => `
                    <tr>
                        <td>${prop.title}</td>
                        <td>${prop.type}</td>
                        <td>${prop.price}</td>
                        <td>${renderStatusBadge(prop.status)}</td>
                        <td>${renderActionColumn(prop.property_id)}</td>
                    </tr>
                `).join('');

                return `
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr><th>Title</th><th>Type</th><th>Price</th><th>Status</th><th>Action</th></tr>
                        </thead>
                        <tbody>${rows}</tbody>
                    </table>
                `;
            }

            var table = $('#projectsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('projects.data') }}",
                pageLength: 5,
                columns: [

                     {
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                   
                    { data: 'project_title', name: 'project_title' },                   
                    { data: 'progress', name: 'progress' }, 
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                paging: true, // Ensure pagination is enabled
                searching: true, // Enable search
                ordering: true, // Enable sorting
                info: true // Show info text (e.g., "Showing 1 to 5 of 25 entries")
            });

            $('#projectsTable tbody').on('click', 'td.dt-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // Row is already open
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
        });      

    </script>
@endsection
