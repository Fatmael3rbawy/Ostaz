<div class="card">
    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1 d-flex justify-content-center" >
        <a href="javascript:;" class="d-block">
            <img src="{{ asset($list->attachments()->where('key', 'app setting logo')->first()->file ?? '') }}" class="img-fluid border-radius-lg">
        </a>
    </div>

    <div class="card-body py-2 d-flex justify-content-center" style="height: 150px">
        <a class="card-title h5 d-block text-darker my-2">
            {{ $list->welcome_message }}
        </a>
    </div>
</div>
