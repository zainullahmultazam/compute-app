@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buku - Edit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.buku.update', $buku->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id"
                        class="form-control @error('kategori_id') is-invalid @enderror" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ old('kategori_id', $buku->kategori_id) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul"
                        class="form-control @error('judul') is-invalid @enderror" 
                        value="{{ old('judul', $buku->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis">Penulis</label>
                    <input type="text" name="penulis" id="penulis"
                        class="form-control @error('penulis') is-invalid @enderror" 
                        value="{{ old('penulis', $buku->penulis) }}" required>
                    @error('penulis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Cover -->
                <div class="mb-3">
                    <label for="cover">Cover Buku</label>
                    <input type="file" name="cover" id="cover"
                        class="form-control @error('cover') is-invalid @enderror" accept="image/*"
                        onchange="previewImage(event)">
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <!-- Preview Image -->
                    <div class="mt-3" id="cover-preview" style="display: {{ $buku->cover ? 'block' : 'none' }}">
                        <label for="cover" class="form-label">Pratinjau Cover:</label>
                        <img id="cover-image" src="{{ $buku->cover ? asset($buku->cover) : '' }}" alt="Cover Preview"
                            class="img-fluid" style="max-width: 200px">
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status"
                        class="form-control @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status', $buku->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $buku->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Perbarui Buku</button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        // Function to preview image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById("cover-image");
                const previewContainer = document.getElementById("cover-preview");
                imagePreview.src = reader.result;
                previewContainer.style.display = "block";
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
