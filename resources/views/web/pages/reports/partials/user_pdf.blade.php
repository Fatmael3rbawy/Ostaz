<!DOCTYPE html>
<html lang="en">

@include('web.layouts.head')

<body class="" >
    <main class="main-content main-content-bg mt-0">
        <section>
                <div class="container">
                    <div class="row">
                        <h1>Ostaz App </h1>
                        <h3>Users Report </h3>
                        @include('web.pages.reports.partials.users_table')
                    </div>
                </div>
        </section>
    </main>

    <script>window.print();</script>
    @include('web.layouts.scripts')
</body>

</html>


