<div class="nav-wrapper position-relative end-0">
    <ul class="nav nav-pills nav-fill p-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 @if(Route::is('report.instructor') ) active @endif" href="{{ route('report.instructor') }}" role="tab"
                aria-selected="true">
                Instructors
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 @if(Route::is('report.user')) active @endif" href="{{ route('report.user') }}" role="tab"
                aria-controls="dashboard" aria-selected="true">
                Users
            </a>
        </li>
    </ul>
</div>
