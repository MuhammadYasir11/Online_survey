@extends('admin/layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $survey_title }}</h4>
                            </div>
                            <div class="card-body">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <form action="" method="post" id="QuestionForm" name="QuestionForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Question</label>
                                    <input type="text" name="question" id="question" class="form-control"
                                        placeholder="Question">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Question Type:</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">--Select Type--</option>
                                        <option value="mcq">Multiple Choice</option>
                                        <option value="text-box">Text Box</option>
                                        <option value="radio">Radio Button</option>
                                        <option value="customRange">Range Slider</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" id="options" style="display: none;">
                            <div class="container-fluid my-2">
                                <div class="row mb-2">
                                    {{-- Answer Gen --}}
                                    <div class="col-sm-4">
                                        <div class="editor-bottom">
                                            <div bottom-wrapper>
                                                <div id="answerBankSection" class="answer-bank-toolbar"></div>
                                                <div class="answer-bank-label">
                                                    <span class="smf-icon genius-icon"><strong>õ</strong></span>
                                                    <span class="answer-genius-text"><strong> Answer Genius</strong>
                                                    </span>
                                                    <span class="answer-bank-help">
                                                        <a class="q " data-help="help-answer-genius">
                                                            <span class="notranslate">?</span>
                                                        </a>
                                                    </span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <label for="scale">scale</label>
                                    <div class="col-sm-2">

                                        <select name="scale" id="scale" class="form-control">
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                        </select>

                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <select name="answerSelect" id="answerSelect" class="form-control">
                                            <option value="">--select type--</option>
                                            <option value="Agree-Disagree">Agree-Disagree</option>
                                            <option value="Satisfied-Dissatisfied">Satisfied-Dissatisfied</option>
                                            <option value="Yes-No">Yes-No</option>
                                            <option value="Likely-Unlikely">Likely-Unlikely</option>
                                            <option value="Familar-Not Familar">Familar-Not Familar</option>
                                            <option value="Always-Never">Always-Never</option>
                                            <option value="True-False">True-False</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div id="optionsContainer">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <div class="input-group">
                                        <input type="text" name="options[]" id="options" placeholder="Multiple choice"
                                            class="form-control">
                                            <p></p>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-plus addOption" data-target="#optionsContainer"></i>
                                            </span>
                                            <span class="input-group-text">
                                                <i class="fas fa-minus removeOption" data-target="#optionsContainer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <div class="input-group">
                                        <input type="text" id="options" name="options[]"
                                            class="form-control option-input" placeholder="Multiple choice">
                                            <p></p>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-plus addOption" data-target="#optionsContainer"></i>
                                            </span>
                                            <span class="input-group-text">
                                                <i class="fas fa-minus removeOption" data-target="#optionsContainer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="addOption">Add Option</button>
                        </div>

                        <div class="form-group" id="textbox" style="display: none;">
                            <div id="textboxContainer">
                                <input type="text" id="add_text" name="add_text" class="form-control"
                                    placeholder="Add text">
                                        <p></p>
                            </div>
                            {{-- <button type="button" class="btn btn-primary mt-2" id="addTextbox">Add textbox</button> --}}
                        </div>

                        <div class="form-group" id="radiobutton" style="display: none;">
                            <div id="radioContainer">
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1" value="Option 2">
                                    <div class="input-group">
                                        <input type="text" name="radioOption[]" id="radioOption" class="form-control"
                                            placeholder="Radio button">
                                            <p></p>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-plus addRadio" data-target="#optionsContainer"></i>
                                            </span>
                                            <span class="input-group-text">
                                                <i class="fas fa-minus removeRadio" data-target="#optionsContainer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault1" value="Option 2">
                                    <div class="input-group">
                                        <input type="text" name="radioOption[]" id="radioOption" class="form-control"
                                            placeholder="Radio button">
                                            <p></p>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-plus addRadiobutton" data-target="#optionsContainer"></i>
                                            </span>
                                            <span class="input-group-text">
                                                <i class="fas fa-minus removeRadio" data-target="#optionsContainer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="addRadiobutton" hidden>Add
                                RadioButton</button>
                        </div>
                        <div class="form-group" id="customRange" style="display: none;">
                            <div id="rangeContainer">
                                <label for="customRange" class="form-label">Select Range</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" id="min" name="min" class="form-control"
                                            placeholder="Enter Min">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="max" name="max" class="form-control"
                                            placeholder="Enter Max">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="mid" name="mid" class="form-control"
                                            placeholder="Enter Mid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Add Question</button>
                        @foreach ($questions as $question)
                            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <!-- Other code related to displaying questions -->
                        @endforeach
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('customJs')
    <script>
        // Select Scale dropdown and add textbox and fill data accordig to answertype 
        document.addEventListener('DOMContentLoaded', function() {
            const scaleSelect = document.getElementById('scale');
            const answerSelect = document.getElementById('answerSelect');
            const optionsContainer = document.getElementById('optionsContainer');
            const addOptionButton = document.getElementById('addOption');

            scaleSelect.addEventListener('change', function() {
                const scaleValue = parseInt(scaleSelect.value);

                // Clear previous options
                optionsContainer.innerHTML = '';

                // Add textboxes based on the selected scale value
                for (let i = 1; i <= scaleValue; i++) {
                    const optionWrapper = document.createElement('div');
                    optionWrapper.className = 'form-group form-check d-flex ';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.className = 'form-check-input';
                    checkbox.id = 'exampleCheck' + i;

                    const textboxWrapper = document.createElement(
                        'div'); // Create a wrapper for textbox and icons
                    textboxWrapper.className = 'input-group';

                    const textbox = document.createElement('input');
                    textbox.type = 'text';
                    textbox.className = 'form-control';
                    textbox.placeholder = 'Multiple Choice ' + i;

                    // Plus icon
                    const plusIcon = document.createElement('span');
                    plusIcon.className = 'input-group-text addOption d-flex';
                    plusIcon.innerHTML = '<i class="fas fa-plus"></i>';

                    // Minus icon add 
                    const minusIcon = document.createElement('span');
                    minusIcon.className = 'input-group-text removeOption';
                    minusIcon.innerHTML = '<i class="fas fa-minus"></i>';

                    // Update the textbox value when answer type is selected
                    answerSelect.addEventListener('change', function() {
                        textbox.value = answerSelect.value;
                    });

                    optionWrapper.appendChild(checkbox);
                    optionWrapper.appendChild(textbox);
                    optionWrapper.appendChild(plusIcon);
                    optionWrapper.appendChild(minusIcon);
                    optionsContainer.appendChild(optionWrapper);
                }
            });
            // Rest of your JavaScript code...
        });

        // Select Scale dropdown and add Radiobutton and fill data accordig to answertype 
        document.addEventListener('DOMContentLoaded', function() {
            const scaleSelect = document.getElementById('scale');
            const answerSelect = document.getElementById('answerSelect');
            const radioContainer = document.getElementById('radioContainer');
            const addOptionButton = document.getElementById('addRadiobutton');

            scaleSelect.addEventListener('change', function() {
                const scaleValue = parseInt(scaleSelect.value);

                // Clear previous radio buttons
                radioContainer.innerHTML = '';

                // Add radio buttons based on the selected scale value
                for (let i = 1; i <= scaleValue; i++) {
                    const radioWrapper = document.createElement('div');
                    radioWrapper.className = 'form-check form-group';

                    const radioButton = document.createElement('input');
                    radioButton.type = 'radio';
                    radioButton.className = 'form-check-input';
                    radioButton.name = 'flexRadioDefault';
                    radioButton.id = 'flexRadioDefault' + i;

                    const textbox = document.createElement('input');
                    textbox.type = 'text';
                    textbox.className = 'form-control';
                    textbox.placeholder = 'Radio button ' + i;

                    // Plus icon
                    const plusIcon = document.createElement('span');
                    plusIcon.className = 'input-group-text addOption d-flex';
                    plusIcon.innerHTML = '<i class="fas fa-plus"></i>';

                    // Minus icon add 
                    const minusIcon = document.createElement('span');
                    minusIcon.className = 'input-group-text removeOption';
                    minusIcon.innerHTML = '<i class="fas fa-minus"></i>';

                    // Update the textbox value when answer type is selected
                    answerSelect.addEventListener('change', function() {
                        textbox.value = answerSelect.value;
                    });


                    radioWrapper.appendChild(radioButton);
                    radioWrapper.appendChild(textbox);

                    radioContainer.appendChild(radioWrapper);
                }

                // Show the add option button
                addOptionButton.style.display = 'none';
            });

            // Rest of your JavaScript code...
        });
        // choose option fill textbox answer type select
        document.addEventListener('DOMContentLoaded', function() {
            const answerSelect = document.getElementById('answerSelect');
            const textboxes = document.querySelectorAll('#optionsContainer input[type="text"]');

            answerSelect.addEventListener('change', function() {
                const selectedOption = answerSelect.value;

                // Fill all textboxes with the selected option
                textboxes.forEach(function(textbox) {
                    textbox.value = selectedOption;
                });
            });

            // Your existing code...
        });
        // Radiobutton fill textbox answer type select
        document.addEventListener('DOMContentLoaded', function() {
            const answerSelect = document.getElementById('answerSelect');
            const textboxes = document.querySelectorAll('#radioContainer input[type="text"]');

            answerSelect.addEventListener('change', function() {
                const selectedOption = answerSelect.value;

                // Fill all textboxes with the selected option
                textboxes.forEach(function(radiobutton) {
                    radiobutton.value = selectedOption;
                });
            });

            // Your existing code...
        });
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const optionsDiv = document.getElementById('options');
            const textboxDiv = document.getElementById('textbox');
            const radiobuttonDiv = document.getElementById('radiobutton');
            const rangeContainerDiv = document.getElementById('customRange');
            const addOptionButton = document.getElementById('addOption');
            const addRadioButton = document.getElementById('addRadioButton');

            typeSelect.addEventListener('change', function() {
                if (typeSelect.value === 'mcq') {
                    optionsDiv.style.display = 'block';
                    textboxDiv.style.display = 'none';
                    radiobuttonDiv.style.display = 'none';
                    addOptionButton.style.display = 'none'
                    rangeContainerDiv.style.display = 'none';
                } else if (typeSelect.value === 'text-box') {
                    optionsDiv.style.display = 'none';
                    textboxDiv.style.display = 'block';
                    radiobuttonDiv.style.display = 'none';
                    rangeContainerDiv.style.display = 'none';
                } else if (typeSelect.value === 'radio') {
                    optionsDiv.style.display = 'block';
                    addOptionButton.style.display = 'block';
                    optionsContainer.style.display = 'none';
                    textboxDiv.style.display = 'none';
                    radiobuttonDiv.style.display = 'block';
                    addOptionButton.style.display = 'none'
                    rangeContainerDiv.style.display = 'none';
                    addRadioButton.style = 'none';
                } else if (typeSelect.value === 'customRange') {
                    optionsDiv.style.display = 'none';
                    textboxDiv.style.display = 'none';
                    radiobuttonDiv.style.display = 'none';
                    rangeContainerDiv.style.display = 'block';
                } else {
                    optionsDiv.style.display = 'none';
                    textboxDiv.style.display = 'none';
                    radiobuttonDiv.style.display = 'none';
                    rangeContainerDiv.style.display = 'none';
                    scaleDiv.style.display = 'none'; // Hide scale dropdown
                    answerSelectDiv.style.display = 'none'; // Hide answer select dropdown

                }
            });

            // const addOptionButton = document.getElementById('addOption');
            // addOptionButton.addEventListener('click', function() {
            //     const optionsContainer = document.getElementById('optionsContainer');

            //     // Create wrapper div for the option
            //     const optionWrapper = document.createElement('div');
            //     optionWrapper.className = 'form-group form-check';

            //     // Create checkbox
            //     const checkbox = document.createElement('input');
            //     checkbox.type = 'checkbox';
            //     checkbox.className = 'form-check-input';

            //     // Create textbox
            //     const textbox = document.createElement('input');
            //     textbox.type = 'text';
            //     textbox.className = 'form-control';
            //     textbox.placeholder = 'Multiple choice';

            //     // Append checkbox and textbox to wrapper
            //     optionWrapper.appendChild(checkbox);
            //     optionWrapper.appendChild(textbox);

            //     // Append wrapper to options container
            //     optionsContainer.appendChild(optionWrapper);
            // });

            // const addRadiobuttonButton = document.getElementById('addRadiobutton');
            // addRadiobuttonButton.addEventListener('click', function() {
            //     const radioContainer = document.getElementById('radioContainer');
            //     // Create container div for the radio button and its label
            //     const containerDiv = document.createElement('div');
            //     containerDiv.className = 'form-check form-group';

            //     // Create radio button
            //     const radioButton = document.createElement('input');
            //     radioButton.type = 'radio';
            //     radioButton.className = 'form-check-input';
            //     radioButton.name = 'flexRadioDefault';

            //     // Create label for radio button
            //     const label = document.createElement('label');
            //     label.className = 'form-check-label';

            //     // Create text input for labeling the radio button
            //     const labelText = document.createElement('input');
            //     labelText.type = 'text';
            //     labelText.className = 'form-control';
            //     labelText.placeholder = 'Radio button';

            //     // Append radio button and text input to the label
            //     label.appendChild(radioButton);
            //     label.appendChild(labelText);

            //     // Append label to the container div
            //     containerDiv.appendChild(label);

            //     // Append container div to the radio container
            //     radioContainer.appendChild(containerDiv);
            // });

        });
    </script>
    <script id="help-answer-genius" type="text/html">
    <h5>ANSWER GENIUS</h5>
    <p>Don't worry about wording your answer choices correctly—just choose the answer type that best matches your question, and we'll fill in expert answer choices for you. If your question asks how difficult something was, choose Easy - Difficult from the dropdown. Then choose whether you want people to rate difficulty on a 2, 3, 4, 5, or 7-point scale.</p>
    <a href="https://help.surveymonkey.com/en/surveymonkey/create/answer-genius" class="learn-more-link wds-button wds-button--sm wds-button--text-link" target="_blank" data-help="help-answer-genius">
        Learn more
    </a>
</script>

    <script>
        $(document).ready(function() {
            // Function to add option dynamically
            $('#addOption').click(function() {
                // Clone the first option input group
                var newOption = $('#optionsContainer .form-group:first').clone();

                // Clear the input value in the cloned option
                newOption.find('input[type="text"]').val('');
                // Append the cloned option input group to the options container
                $('#optionsContainer').append(newOption);
            });

            // Function to handle form submission
            $('#QuestionForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Serialize the form data including dynamically added inputs
                var formData = $(this).serialize();

                // Send form data via AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('question.store') }}',
                    data: formData,
                    success: function(response) {
                        if (response.status == true) {
                            console.log("Redirect URL:", "{{ route('admin.home.list') }}");
                            window.location.href = "{{ route('admin.home.list') }}";
                            // Optionally, you may remove validation errors UI here
                            console.log("Question Added successfully");
                            location.reload();
                        } else {
                            var errors = response.errors ||
                            {}; // Default to empty object if errors are not present
                            if (errors.hasOwnProperty('question')) {
                                $("#question").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.question[0]);
                            } else {
                                $("#question").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('type')) {
                                $("#type").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.type[0]);
                            } else {
                                $("#type").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('options')) {
                                $("#options").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.options[0]);
                            } else {
                                $("#options").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('add_text')) {
                                $("#add_text").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.add_text[0]);
                            } else {
                                $("#add_text").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('radioOption')) {
                                $("#radioOption").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.radioOption[0]);
                            } else {
                                $("#radioOption").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('min')) {
                                $("#min").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.min[0]);
                            } else {
                                $("#min").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('max')) {
                                $("#max").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.max[0]);
                            } else {
                                $("#max").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }

                            if (errors.hasOwnProperty('mid')) {
                                $("#mid").addClass('is-invalid').siblings('p')
                                    .addClass('invalid-feedback').html(errors.mid[0]);
                            } else {
                                $("#mid").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error("An error occurred:", error);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.addOption').click(function() {
                // Clone the form group containing checkbox and text input
                var newOption = $('#optionsContainer .form-group:first').clone();

                // Clear values of cloned input fields
                newOption.find('input[type="text"]').val('');
                newOption.find('input[type="checkbox"]').prop('checked', false);

                $('#optionsContainer').append(newOption);

                // Append the cloned form group to the container
                $(this).closest('.form-group').after(newOption);
            });
            // Functionality for removing option
            $(document).on('click', '.removeOption', function() {
                if ($('#optionsContainer .form-group').length > 1) {
                    $(this).closest('.form-group').remove();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.addRadiobutton').click(function() {
                // Clone the form group containing checkbox and text input
                var newOption = $('#radioContainer .form-group:first').clone();

                // Clear values of cloned input fields
                newOption.find('input[type="text"]').val('');
                newOption.find('input[type="radio"]').prop('radio', false);

                $('#radioContainer').append(newOption);

                // Append the cloned form group to the container
                $(this).closest('.form-group').after(newOption);
            });
            // Functionality for removing option
            $(document).on('click', '.removeRadio', function() {
                if ($('#radioContainer .form-group').length > 1) {
                    $(this).closest('.form-group').remove();
                }
            });
        });
    </script>
@endsection
