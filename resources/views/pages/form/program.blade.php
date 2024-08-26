<x-user title="Formulir Program Sosial"
    name="Formulir Program Sosial">

    <div class="container py-4">
        <form action="{{ route('form.program') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card h-100 border-0 shadow rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-3">Bentuk program sosial yang dikelola oleh DKM</h5>

                <!-- Bentuk Program Sosial -->
                <div class="mb-3">
                    <label class="form-label">Bentuk Program Sosial yang Dikelola oleh DKM</label>
                    @foreach([
                        'Bantuan sosial sesekali, dilaksanakan insidental (ex. Bantuan bencana).',
                        'Bantuan sosial di momen-momen tertentu (ex. Santunan di PHBI dll).',
                        'Bantuan sosial dan program pemberdayaan (program non pemberdayaan masih mendominasi).',
                        'Program pemberdayaan 4 pilar (pendidikan, ekonomi, lingkungan dan kesehatan).'
                    ] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="social_program"
                                value="{{ $option }}" id="social_program{{ $loop->index + 1 }}"
                                {{ old('social_program', $pillarThree->social_program ?? '') == $option ? 'checked' : '' }}>
                            <label class="form-check-label" for="social_program{{ $loop->index + 1 }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                    @error('social_program')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Dokumen Pendukung -->
                <div class="mb-3">
                    <label for="supporting_docs_social_program" class="form-label">Dokumen Pendukung</label>
                    <input class="form-control" type="file" id="supporting_docs_social_program" name="supporting_docs_social_program[]" multiple>
                    @if (isset($pillarThree->supporting_docs_social_program))
                        @foreach($pillarThree->supporting_docs_social_program as $doc)
                            <a href="{{ Storage::url($doc) }}" target="_blank">Lihat Dokumen</a><br>
                        @endforeach
                    @endif
                    @error('supporting_docs_social_program')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Penerima Manfaat Program Sosial -->
                <div class="mb-3">
                    <label class="form-label">Penerima Manfaat Program Sosial</label>
                    @foreach([
                        'Belum ada Penerima Manfaat.',
                        'Ring 1 perusahaan.',
                        'Ring 1 dan di luar Ring 1 Perusahaan.'
                    ] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="beneficiaries"
                                value="{{ $option }}" id="beneficiaries{{ $loop->index + 1 }}"
                                {{ old('beneficiaries', $pillarThree->beneficiaries ?? '') == $option ? 'checked' : '' }}>
                            <label class="form-check-label" for="beneficiaries{{ $loop->index + 1 }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                    @error('beneficiaries')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Jumlah Penerima Manfaat -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Penerima Manfaat</label>
                    <select class="form-select" name="beneficiaries_count">
                        @foreach(['0', '< 100', '100 – 1000', '> 1000'] as $option)
                            <option value="{{ $option }}" {{ old('beneficiaries_count', $pillarThree->beneficiaries_count ?? '') == $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                    @error('beneficiaries_count')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Sumber Pembiayaan -->
                <div class="mb-3">
                    <label class="form-label">Sumber Pembiayaan</label>
                    @foreach([
                        'Kotak amal masjid.',
                        'Sumbangan jamaah atau karyawan via transfer.',
                        'Sumbangan dari perusahaan.',
                        'Sumbangan via digital (QRIS dll).',
                        'Sumbangan via payroll.'
                    ] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="funding_sources[]"
                                value="{{ $option }}" id="funding_sources{{ $loop->index + 1 }}"
                                {{ in_array($option, old('funding_sources', $pillarThree->funding_sources ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="funding_sources{{ $loop->index + 1 }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                    @error('funding_sources')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Dokumen Pendukung untuk Sumber Pembiayaan -->
                <div class="mb-3">
                    <label for="supporting_docs_funding_sources" class="form-label">Dokumen Pendukung</label>
                    <input class="form-control" type="file" id="supporting_docs_funding_sources" name="supporting_docs_funding_sources[]" multiple>
                    @if (isset($pillarThree->supporting_docs_funding_sources))
                        @foreach($pillarThree->supporting_docs_funding_sources as $doc)
                            <a href="{{ Storage::url($doc) }}" target="_blank">Lihat Dokumen</a><br>
                        @endforeach
                    @endif
                    @error('supporting_docs_funding_sources')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Program Sustainability di DKM -->
                <div class="mb-3">
                    <label class="form-label">Program Sustainability di DKM</label>
                    <textarea class="form-control" name="sustainability_program" rows="3">{{ old('sustainability_program', $pillarThree->sustainability_program ?? '') }}</textarea>
                    @error('sustainability_program')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Program sesuai dengan Astra Sustainability Aspiration -->
                <div class="mb-3">
                    <label class="form-label">Jelaskan dengan Sebutkan Program yang sesuai dengan Astra Sustainability Aspiration</label>
                    @foreach([
                        'Hemat Air.',
                        'Hemat Listrik.',
                        'Pengelolaan sampah.'
                    ] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sustainability_programs[]"
                                value="{{ $option }}" id="sustainability_programs{{ $loop->index + 1 }}"
                                {{ in_array($option, old('sustainability_programs', $pillarThree->sustainability_programs ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="sustainability_programs{{ $loop->index + 1 }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                    @error('sustainability_programs')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Dokumen Pendukung untuk Program Sustainability -->
                <div class="mb-3">
                    <label for="supporting_docs_sustainability_program" class="form-label">Dokumen Pendukung</label>
                    <input class="form-control" type="file" id="supporting_docs_sustainability_program" name="supporting_docs_sustainability_program[]" multiple>
                    @if (isset($pillarThree->supporting_docs_sustainability_program))
                        @foreach($pillarThree->supporting_docs_sustainability_program as $doc)
                            <a href="{{ Storage::url($doc) }}" target="_blank">Lihat Dokumen</a><br>
                        @endforeach
                    @endif
                    @error('supporting_docs_sustainability_program')
                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                            
            </div>

        </div>
        </form>
    </div>

</x-user>
