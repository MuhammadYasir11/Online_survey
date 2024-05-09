@extends('admin/layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Survey</h4>
                                <div class="col-sm-10 text-right">
                                    <a href="{{ route('admin.home.list') }}" class="btn btn-primary">View List</a>
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
            <form action="" method="post" id="EditSurvey" name="EditSurvey">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Survey Title</label>
                                    <input type="text" value="{{ $survey->survey_title }}" class="form-control"
                                        name="survey_title" placeholder="Survey Title">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $Category)
                                                <option {{ $Category->id == $survey->category_id ? 'selected' : '' }}
                                                    value="{{ $Category->id }}">{{ $Category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('admin.home.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('customJs')
    <script>
        $("#EditSurvey").submit(function(event) {
            event.preventDefault();
            var element = $(this);

            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route('Survey.update', $survey->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {

                    $("button[type=submit]").prop('disabled', false);

                    if (response["status"] == true) {

                        console.log("Redirect URL:", "{{ route('admin.home.list') }}");
                        window.location.href = "{{ route('admin.home.list') }}";

                        $("#survey_title").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                        $("#category_id").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    } else {

                        var errors = response['errors'];
                        if (errors['survey_title']) {

                            $("#survey_title").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['survey_title']);
                        } else {

                            $("#survey_title").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }

                        if (errors['category_id']) {

                            $("#category_id").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['category_id']);
                        } else {

                            $("#category_id").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }

                },
                error: function(jqXHR, exception) {
                    console.log("Something Went Wrong");
                }

            });
        });
    </script>
@endsection
