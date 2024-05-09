@extends('admin/layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create Survey</h4>
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
            <form action="" method="post" id="survey" name="survey">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Survey Title</label>
                                    <input type="text" id="survey_title" class="form-control" name="survey_title"
                                    placeholder="Survey Title">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if ($category->isNotEmpty())
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit Survey</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('customJs')
{{-- <script>
    $.ajax({
        type: "POST",
        url: '{{ route('Survey.store') }}', // Replace with your actual store route
        data: {
            survey_title: "{{ isset($survey) ? $survey->survey : '' }}",
            category_id: "{{ isset($survey) ? $survey->category_id : '' }}"
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                $surveyTitle = response.survey.survey_title;
                // Display survey title in the div
                $(".mb-3").text($surveyTitle);
                dd($surveyTitle);
            } else {
                // Handle errors if any
                console.log("Error:", response.errors);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
</script> --}}

<script>
    $("#survey").submit(function(event) {
        event.preventDefault();
        var element = $(this);

        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route('Survey.store') }}',
            type: 'post',
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
