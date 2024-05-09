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
                                <h4>Home</h4>
                                <div class="col-sm-11 text-right">
                                    <a href="{{ route('admin.Survey.create') }}" class="btn btn-primary">Create Survey</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h4>Survey List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    Status
                                                </th>
                                                <th>Survey Title</th>
                                                <th>Modified Date</th>
                                                <th>Edit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($surveys->isNotEmpty())
                                                @foreach ($surveys as $survey)
                                                    <tr>
                                                        @php
                                                            $status = $survey->isPublishedToStudents()
                                                                ? 'Open'
                                                                : 'Draft';
                                                            $statusColor =
                                                                $status === 'Open' ? 'text-success' : 'text-danger';
                                                        @endphp
                                                        <td class="{{ $statusColor }}">{{ $status }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ route('admin.home.Surveydashboard', ['id' => $survey->id]) }}">{{ $survey->survey_title }}</a>
                                                        </td>
                                                        <td>{{ $survey->created_at }}</td>
                                                        <td>
                                                            <button type="submit"
                                                                onclick="window.location.href='{{ route('admin.Survey.edit', ['id' => $survey->id]) }}'"
                                                                class="btn btn-outline-secondary">
                                                                Edit Survey
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-secondary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="modal" data-target="">
                                                                    Publish
                                                                </button>
                                                                <!-- Inside the dropdown menu -->
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">

                                                                    <a class="dropdown-item" href="#"
                                                                        id="publishStudent">Student</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        id="publishTeacher">Teacher</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        id="publishLink">Link</a>
                                                                    <a class="dropdown-item" href="#"
                                                                        id="publishAll">All</a>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5">Record Not Found</td>
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

    <!-- After the table of surveys -->
    <div id="publishMessage"></div>

    <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="publishModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to publish the survey now?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmPublish">Publish</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            // Handle dropdown toggle on click of the icon
            $('.dropdown-toggle').on('click', function(e) {
                $(this).next('.dropdown-menu').toggle();
            });

            // Close dropdown when clicked outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });

            $('#publishStudent').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior
                sendSurvey(2, 'student');
                $('#publishModal').modal('show'); // Show the confirmation modal
                $('#confirmPublish').off('click').on('click', function() {
                    // Code to publish to students
                    alert('Survey published to students successfully!');
                    $('#publishModal').modal('hide'); // Hide the modal
                    $('#publishMessage').text(
                        'Your survey is published to students.'); // Update message

                });
            });

            $('#publishTeacher').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior
                sendSurvey(3,'teacher');
                $('#publishModal').modal('show'); // Show the confirmation modal
                $('#confirmPublish').off('click').on('click', function() {
                    // Code to publish to teachers
                    alert('Survey published to teachers successfully!');
                    $('#publishModal').modal('hide'); // Hide the modal
                    $('#publishMessage').text(
                        'Your survey is published to teachers.'); // Update message

                });
            });

            function sendSurvey(role,surveyId,publishType) {
                // You can use AJAX to send the survey data to the backend
                // Example:
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.home.send_survey') }}',// Replace with your backend endpoint
                    data: {
                        role: role, // Send the role information to the backend
                        survey_id: surveyId, // Pass the survey ID to the backend
                        publish_type: publishType // Send the selected publish type to the backend
                    },
                    success: function(response) {
                        // Handle success
                        console.log('Survey sent successfully to role: ' + role);
                        console.log('Survey published successfully to ' + publishType);

                        $('#publishMessage').text('Your survey is published to ' + publishType);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error sending survey:', error);
                    }
                });
            }
        });
    </script>
@endsection
