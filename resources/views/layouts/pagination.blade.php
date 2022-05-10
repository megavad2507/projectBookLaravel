@if($paginator->lastPage() > 1)
    <div class="row">
        <div class="col-12">
            <nav class="pagination-section mt-30">
                <div class="row align-items-center">
                    <div class="col-12">
                        <ul class="pagination justify-content-center">
                            @if(!$paginator->onFirstPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="ion-chevron-left"></i></a>
{{--                                    @if($paginator->currentPage() == 2)--}}
{{--                                        <a class="page-link" href="{{ route('category',$category->code) }}"><i class="ion-chevron-left"></i></a>--}}
{{--                                    @else--}}
{{--                                        --}}
{{--                                    @endif--}}
                                </li>
                            @endif
                            @for($i = 1;$i <= $paginator->lastPage(); $i++)
                                <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
{{--                                    @if($i == 1)--}}
{{--                                        <a class="page-link" href="{{ route('category',$category->code) }}" {{ ($paginator->currentPage() == $i) ? ' disabled' : '' }}>{{ $i }}</a>--}}
{{--                                    @else--}}
{{--                                        <a class="page-link" href="{{ $paginator->url($i) }}" {{ ($paginator->currentPage() == $i) ? ' disabled' : '' }}>{{ $i }}</a>--}}
{{--                                    @endif--}}
                                    <a class="page-link" href="{{ $paginator->url($i) }}" {{ ($paginator->currentPage() == $i) ? ' disabled' : '' }}>{{ $i }}</a>
                                </li>
                            @endfor
                            @if($paginator->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="ion-chevron-right"></i></a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
@endif
