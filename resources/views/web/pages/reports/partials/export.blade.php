<div class="col-2">
    <a href="{{ request()->fullUrlWithQuery(['export' => 'excel']) }} " type="button" class="btn btn-facebook btn-icon">
        <span class="btn-inner--icon">excel</span>
    </a>
    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}" type="button" class="btn btn-facebook btn-icon">
        <span class="btn-inner--icon">pdf</i></span>
    </a>

</div>