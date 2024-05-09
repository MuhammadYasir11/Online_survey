@extends('admin/layouts.app')
@section('content')

    <style>
        .publish-message {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>

    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>AddCategory</h4>
                                <div class="col-sm-11 text-right">
                                    <a href="{{ route('admin.Category.create') }}" class="btn btn-primary">New Category</a>
                                </div>
                            </div>
                            <div class="card-body">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('admin.message')
                        <div class="card">
                            <div class="card-header">
                                <h4>Category List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    Id
                                                </th>
                                                <th>Category Name</th>
                                                <th>Category Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $Categories)
                                                    <tr>
                                                        <td>{{ $Categories->id }}</td>
                                                        <td>{{ $Categories->name }}</td>
                                                        <td>{{ $Categories->title }}</td>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.Category.edit', $Categories->id) }}" class="btn btn-primary">Edit
                                                            </a>
                                                            <a href="#" onclick="deleteCategory({{ $Categories->id }})" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5"> Record Not Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('customJs')
    <script>
        function deleteCategory(id) {
            var url = '{{ route('categories.delete', 'ID') }}';
            var newUrl = url.replace("ID", id);


            if (confirm("Are You Sure You Want To Delete")) {
                $.ajax({

                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response["status"]) {
                            window.location.href = "{{ route('admin.Category.list') }}";
                        }
                    }
                });
            }
        }
    </script>
@endsection
