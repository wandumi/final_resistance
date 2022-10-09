@include("backend.header")

@include("backend.sidebar")

<div id="content-wrapper" class="d-flex flex-column">
    <div id="app">
        <div id="content">

            @include("backend.topbar")

            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">

                @yield("content")


                @include("backend.modal")

            </div>
            <!---Container Fluid-->
        </div>
        <!-- Footer -->
    </div>
@include("backend.footer")
