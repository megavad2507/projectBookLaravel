@if (count($breadcrumbs))
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 breadcrumb-bg1 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-title text-center my-20">
                        <h2 class="title text-dark text-capitalize">{{ $breadcrumbs->last()->title }}</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol
                        class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
                    >
                        @foreach ($breadcrumbs as $breadcrumb)

                            @if ($breadcrumb->url && !$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                            @endif

                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
@endif
