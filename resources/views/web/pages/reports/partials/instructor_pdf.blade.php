<!DOCTYPE html>
<html lang="en">

@include('web.layouts.head')

<body>
    <main class="main-content main-content-bg mt-0">
        <section>
            <div class="container">
                <div class="row">
                    <h1>Ostaz App </h1>
                    <h3>Instructors Report </h3>
                    @include('web.pages.reports.partials.instructors_table')
                </div>
            </div>
        </section>
    </main>


    <script type="text/javascript">
         window.print();
    </script>
    @include('web.layouts.scripts')
</body>

</html>
