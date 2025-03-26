{{-- Success Alert --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible  show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Error Alert --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible  show" role="alert">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if ($errors->any())
    
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
           {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    
@endif