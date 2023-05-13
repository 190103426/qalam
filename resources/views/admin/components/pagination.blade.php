{{--
AppServiceProvider
 boot
    Paginator::useBootstrap();
--}}

<div class="text-center mt-4">
    <p>{{ $paginator->lastItem() }} @if(isset($text)) {{ $text }} @endif из {{$paginator->total()}}</p>
    <div class="d-flex justify-content-center">
        {!! $paginator->links() !!}
    </div>
</div>
