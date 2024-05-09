<!-- Your Blade Template -->

@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Active and Trial Users</div>
                        <div class="card-body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const question = <?php echo json_encode($questionData)?>;
            const optionData = {!! json_encode($optionData) !!};

            // Format questionData and optionData if needed

            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Student and Teacher Survey'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Users'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'Questions',
                    data: question
                }]
            });
        });
    </script>
@endsection
