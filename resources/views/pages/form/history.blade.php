<x-user title="Riwayat Formulir" name="Riwayat Formulir">
    {{-- Custom CSS --}}
    @prepend('styles')
        <style>
            button.accordion-button {
                color: #004ea2;
                font-weight: 500;
            }

            button.accordion-button:focus {
                outline: none;
                box-shadow: none;
            }

            button.accordion-button.collapsed {
                border-bottom: 1px solid transparent;
            }

            button.accordion-button:not(.collapsed) {
                color: #004ea2;
                box-shadow: none;
                background-color: transparent;
                border-bottom: 1px solid #eeeeee;
            }
        </style>
    @endprepend

    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <div class="row justify-content-sm-end mb-4">
                            <div class="col-sm-6 col-xl-4 mt-3 mt-sm-0">
                                <form>
                                    <select name="tahun" id="tahun" class="form-select">
                                        @php
                                            $currentYear = date('Y');
                                            $startYear = 2023;
                                        @endphp

                                        @for ($year = $startYear; $year <= $currentYear; $year++)
                                            <option value="{{ $year }}"
                                                {{ request('tahun', $currentYear) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        <span class="me-3">Hubungan DKM dengan YAA</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($pillarTwo)
                                            <ol class="list-group list-group-numbered mb-0">
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarTwo->question_two)
                                                        @php
                                                            $questions = json_decode($pillarTwo->question_two, true);
                                                            $filteredQuestions = array_filter($questions, function (
                                                                $value,
                                                            ) {
                                                                return $value !== 'custom';
                                                            });

                                                            $filteredQuestionsString = implode(
                                                                ', ',
                                                                $filteredQuestions,
                                                            );
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}{{ $pillarTwo->option_two ? ', ' . $pillarTwo->option_two : '' }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarTwo->file_question_two)
                                                        <a href="{{ url($pillarTwo->file_question_two) }}"
                                                            class="btn btn-sm btn-secondary" download>
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarTwo->question_three)
                                                        @php
                                                            $questions = json_decode($pillarTwo->question_three, true);
                                                            $filteredQuestions = array_filter($questions, function (
                                                                $value,
                                                            ) {
                                                                return $value !== 'custom';
                                                            });

                                                            $filteredQuestionsString = implode(
                                                                ', ',
                                                                $filteredQuestions,
                                                            );
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}{{ $pillarTwo->option_three ? ', ' . $pillarTwo->option_three : '' }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarTwo->file_question_three)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarTwo->file_question_three, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarTwo->question_four)
                                                        @php
                                                            $questions = json_decode($pillarTwo->question_four, true);
                                                            $filteredQuestions = array_filter($questions, function (
                                                                $value,
                                                            ) {
                                                                return $value !== 'custom' &&
                                                                    $value !== 'Kegiatan Sinergi lainnya';
                                                            });

                                                            $filteredQuestionsString = implode(
                                                                ', ',
                                                                $filteredQuestions,
                                                            );
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}{{ $pillarTwo->option_four ? ', ' . $pillarTwo->option_four : '' }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarTwo->file_question_four)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarTwo->file_question_four, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarTwo->question_five)
                                                        @php
                                                            $questions = json_decode($pillarTwo->question_five, true);
                                                            $filteredQuestionsString = implode(', ', $questions);
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarTwo->file_question_five)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarTwo->file_question_five, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                            </ol>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        <span class="me-3">Hubungan Manajemen Perusahaan dengan DKM dan Jamaah</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($pillarOne)
                                            <ol class="list-group list-group-numbered mb-0">
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->question_one)
                                                            {{ $pillarOne->question_one }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarOne->file_question_one)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarOne->file_question_one, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->question_two)
                                                            {{ $pillarOne->question_two }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarOne->file_question_two_three)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarOne->file_question_two_three, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->file_question_two_one)
                                                            <button type="button"
                                                                class="border-0 p-0 bg-transparent text-primary"
                                                                data-bs-toggle="modal" data-bs-target="#documentModal"
                                                                data-url="{{ url('/' . ltrim($pillarOne->file_question_two_one, '/')) }}">
                                                                Lihat Dokumen
                                                            </button>
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->file_question_two_two)
                                                            <button type="button"
                                                                class="border-0 p-0 bg-transparent text-primary"
                                                                data-bs-toggle="modal" data-bs-target="#documentModal"
                                                                data-url="{{ url('/' . ltrim($pillarOne->file_question_two_two, '/')) }}">
                                                                Lihat Dokumen
                                                            </button>
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->question_three)
                                                            {{ $pillarOne->question_three }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarOne->file_question_three)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarOne->file_question_three, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->question_four)
                                                            {{ $pillarOne->question_four }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarOne->file_question_four)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarOne->file_question_four, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarOne->question_five)
                                                            {{ $pillarOne->question_five }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarOne->file_question_five)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarOne->file_question_five, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                            </ol>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                        <span class="me-3">Program Sosial</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($pillarThree)
                                            <ol class="list-group list-group-numbered mb-0">
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarThree->question_one)
                                                            {{ $pillarThree->question_one }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarThree->question_two)
                                                            {{ $pillarThree->question_two }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarThree->question_three)
                                                            {{ $pillarThree->question_three }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarThree->question_four)
                                                        @php
                                                            $questions = json_decode($pillarThree->question_four, true);
                                                            $filteredQuestions = array_filter($questions, function (
                                                                $value,
                                                            ) {
                                                                return $value !== 'custom';
                                                            });

                                                            $filteredQuestionsString = implode(
                                                                ', ',
                                                                $filteredQuestions,
                                                            );
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}{{ $pillarThree->option_four ? ', ' . $pillarThree->option_four : '' }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarThree->file_question_four)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarThree->file_question_four, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarThree->question_five)
                                                            {{ $pillarThree->question_five }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    @if ($pillarThree->question_six)
                                                        @php
                                                            $questions = json_decode($pillarThree->question_six, true);
                                                            $filteredQuestions = array_filter($questions, function (
                                                                $value,
                                                            ) {
                                                                return $value !== 'custom';
                                                            });

                                                            $filteredQuestionsString = implode(
                                                                ', ',
                                                                $filteredQuestions,
                                                            );
                                                        @endphp

                                                        <div class="ms-2 me-auto pe-4">
                                                            {{ $filteredQuestionsString }}{{ $pillarThree->option_six ? ', ' . $pillarThree->option_six : '' }}
                                                        </div>
                                                    @else
                                                        <div class="ms-2 me-auto pe-4">
                                                            <span class="text-danger">Belum.</span>
                                                        </div>
                                                    @endif

                                                    @if ($pillarThree->file_question_six)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarThree->file_question_six, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                            </ol>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">
                                        <span class="me-3">Administrasi dan Keuangan</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($pillarFour)
                                            <ol class="list-group list-group-numbered mb-0">
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFour->question_one)
                                                            {{ $pillarFour->question_one }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFour->file_question_one)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFour->file_question_one, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFour->question_four)
                                                            {{ $pillarFour->question_four }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFour->file_question_two)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFour->file_question_two, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFour->question_two)
                                                            {{ $pillarFour->question_two }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFour->question_three)
                                                            {{ $pillarFour->question_three }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFour->file_question_four)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFour->file_question_four, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFour->question_five)
                                                            {{ $pillarFour->question_five }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFour->file_question_five)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFour->file_question_five, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                            </ol>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">
                                        <span class="me-3">Peribadahan dan Infrastruktur</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($pillarFive)
                                            <ol class="list-group list-group-numbered mb-0">
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFive->question_one)
                                                            {{ $pillarFive->question_one }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFive->question_two)
                                                            {{ $pillarFive->question_two }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFive->file_question_two)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFive->file_question_two, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFive->question_three)
                                                            {{ $pillarFive->question_three }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFive->file_question_three)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFive->file_question_three, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFive->question_four)
                                                            {{ $pillarFive->question_four }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFive->file_question_four)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFive->file_question_four, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                                <li
                                                    class="list-group-item border-0 rounded-0 px-0 d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto pe-4">
                                                        @if ($pillarFive->question_five)
                                                            {{ $pillarFive->question_five }}
                                                        @else
                                                            <span class="text-danger">Belum.</span>
                                                        @endif
                                                    </div>

                                                    @if ($pillarFive->file_question_five)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                                            data-url="{{ url('/' . ltrim($pillarFive->file_question_five, '/')) }}">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    @endif
                                                </li>
                                            </ol>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button px-0 rounded-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseSix">
                                        <span class="me-3">Presentasi</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse show">
                                    <div class="accordion-body px-0">
                                        @if ($presentation)
                                            <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                                data-bs-toggle="modal" data-bs-target="#documentModal"
                                                data-url="{{ url('/' . ltrim($presentation->file, '/')) }}">
                                                Lihat File Presentasi
                                            </button>
                                        @else
                                            <span class="text-danger">Data tidak ditemukan.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentModalLabel">Lihat Dokumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="documentContent"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#tahun').on('input keydown change', function(e) {
                    if (e.which !== 13) {
                        clearTimeout(debounceTimeout);

                        debounceTimeout = setTimeout(function() {
                            filter();
                        }, 1000);
                    }
                });

                function filter() {
                    const params = {};
                    const year = $('#tahun').val();
                    const url = '{{ route('form_history') }}';

                    if (year !== '') {
                        params.tahun = year;
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#documentModal').on('show.bs.modal', function(event) {
                    let button = $(event.relatedTarget);
                    let url = button.data('url');
                    let modal = $(this);
                    let documentContent = modal.find('#documentContent');

                    documentContent.html('');

                    if (url.match(/\.(jpg|jpeg|png)$/i)) {
                        documentContent.html('<img src="' + url + '" class="img-fluid" alt="Dokumen Gambar">');
                    } else if (url.match(/\.pdf$/i)) {
                        documentContent.html('<embed src="' + url +
                            '" type="application/pdf" width="100%" height="500px" />');
                    } else {
                        documentContent.html('<p>Format file tidak didukung.</p>');
                    }
                });
            });
        </script>
    @endprepend
</x-user>
