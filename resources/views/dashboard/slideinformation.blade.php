@include('dashboard.partials.title')
@include('dashboard.partials.sidebar')
@include('dashboard.partials.navbar')
<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Slide Information</h2>
        <p class="category">Kamu Bisa Mengatur Menu Sliding Informasi Disini</p>

    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Image Viewer</h4>
                </div>
                @foreach ($slideinformation as $singleSlideinformation)
                    <div class="card-body text-center">
                        <!-- Gambar yang ingin ditampilkan -->
                        <div class="text-center">
                            <img src="{{ asset('/storage/slideinformation/upload/' . $singleSlideinformation->gambar) }}"
                                class="img-thumbnail img-portrait bordered-image" data-toggle="modal"
                                data-target="#imageModal">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <form id="update-image-form-{{ $singleSlideinformation->id }}"
                                action="{{ route('updategambarslide', ['id' => $singleSlideinformation->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group" style="display: none;">
                                    <input type="file" name="gambar" class="form-control-file" accept="image/*"
                                        onchange="document.getElementById('update-image-form-{{ $singleSlideinformation->id }}').submit();">
                                </div>
                                @if (auth()->user()->userlevel === 'Admin')
                                <button type="button" class="btn btn-warning"
                                    onclick="document.getElementById('file-upload-{{ $singleSlideinformation->id }}').click();">&#9998;
                                    Ganti Gambar</button>
                                <input id="file-upload-{{ $singleSlideinformation->id }}" type="file" name="gambar"
                                    class="form-control-file" accept="image/*" style="display: none;"
                                    onchange="document.getElementById('update-image-form-{{ $singleSlideinformation->id }}').submit();">

                            </form>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
            <style>
                .bordered-image {
                    border: 4px solid black;
                    /* Border hitam tipis */
                    border-radius: 5px;
                    /* Membuat sudut border agak melengkung */
                }

                .img-portrait {
                    max-width: 100%;
                    /* Memastikan gambar tidak melebihi lebar kontainer */
                    height: auto;
                    /* Memastikan rasio aspek gambar tetap terjaga */
                    width: 380px;
                    /* Atur ukuran maksimum yang diinginkan */
                }

                /* Aturan khusus untuk gambar dalam modal */
                #modalImage {
                    max-width: 100%;
                    /* Memastikan gambar tidak melebihi lebar modal */
                    height: auto;
                    /* Memastikan rasio aspek gambar tetap terjaga */
                    max-height: 80vh;
                    /* Memastikan gambar tidak melebihi tinggi viewport */
                }
            </style>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quotes</h4>
                </div>
                <div class="card-body">
                    <!-- Quote 1 -->
                    @foreach ($slideinformation as $singleSlideinformation)
                        <div class="quote-card">
                            <form action="{{ route('updateQuotes', ['id' => $singleSlideinformation->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <textarea class="form-control mb-3" name="quotes" rows="3">{{ $singleSlideinformation->quotes }}</textarea>
                                @if (auth()->user()->userlevel === 'Admin')
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-warning mr-2">Simpan Quotes</button>
                            </form>
                            @endif


                        </div>


                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
</div><!-- Style untuk mempercantik tampilan card quotes -->
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }



    .card-body {
        padding: 15px;
        background-color: #f8f9fa;
    }

    .quote-card {
        background-color: white;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .blockquote {
        margin: 0;
        padding: 0;
    }

    .blockquote-footer {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>


</div>
</div>








@include('dashboard.partials.corejs')
