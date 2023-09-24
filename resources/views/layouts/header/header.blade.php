<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                   @if(isset($links))
                       @foreach($links as $link)
                           /<a href="{{$link['url']}}">{{$link['name']}}</a>
                       @endforeach
                    @endif
                </h2>
            </div>
            <!-- Page title actions -->
            @stack('actions_top')
        </div>
    </div>
</div>
