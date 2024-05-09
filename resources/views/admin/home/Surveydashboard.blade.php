@extends('admin/layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-secondary mr-2"
                                        onclick="window.location.href='{{ route('admin.Question.create', ['survey' => $id]) }}'">Edit
                                        Design</button>
                                    <button type="button" class="btn btn-info"
                                        onclick="window.location.href='{{ route('admin.Survey.edit', ['id' => $id]) }}'">Edit
                                        Survey</button>
                                </div>                
                            </div>
                            <div class="card-body">
                                <h3>{{ $surveyTitle }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total Response</h5>
                                            <h2 class="mb-3 font-18">6</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                          <img src="{{ asset('admin-assets/img/banner/2.png') }}" alt="">
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Draft</h5>
                                            <h2 class="mb-3 font-18">3</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                          <img src="{{ asset('admin-assets/img/banner/3.png') }}" alt="">
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                  <div class="card ">
                    <div class="card-header">
                      <h4>Chart</h4>
                      <div class="card-header-action">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <div id="chart1"></div>
                          <div class="row mb-0">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($questions as $question)
                                <div class="mb-4">
                                    <strong>Q{{ $loop->iteration }}: {{ $question->question }}</strong>
                                    <div class="float-right">
                                        <a href="{{ route('admin.home.edit', ['id' => $question->id]) }}" class="mr-2"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="text-danger delete-question"
                                            data-question-id="{{ $question->id }}"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                    @if ($question->question_type === 'mcq')
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach ($options->where('question_id', $question->id) as $option)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="option{{ $option->id }}" name="options[]"
                                                                    value="{{ $option->id }}">
                                                                <label class="form-check-label option-label option-font"
                                                                    for="option{{ $option->id }}">{{ $option->option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($question->question_type === 'text-box')
                                        @php
                                            $answer = $question->where('id', $question->id)->first();
                                        @endphp
                                        <input type="text" class="form-control"
                                            name="textbox_question_{{ $question->id }}"
                                            value="{{ $answer ? $answer->answer : '' }}" readonly>
                                    @elseif ($question->question_type === 'radio')
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach ($question->options as $option)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input"
                                                                    id="option{{ $option->id }}"
                                                                    name="radio_question_{{ $question->id }}"
                                                                    value="{{ $option->id }}">
                                                                <label class="form-check-label option-label option-font"
                                                                    for="option{{ $option->id }}">{{ $option->option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($question->question_type === 'customRange')
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach ($min,$max,$mid->where('question_id', $question->id) as $min,$max,$mid)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="range" class="form-control" min="$min" max="$max" mid="$mid">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('customerJs')
@endsection
