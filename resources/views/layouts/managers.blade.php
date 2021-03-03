<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Managers Challenge - Administration</title>
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAACxSagAAAAAALJJqAC1UK0AkDqBAPn5+QCiQZYAizZ8AK5IowCMNnwAsn6oALRLqwCVRIYAkkuDAJ1SkAC5YLIAtlmtAJM8hACDMXIAmj+MAKxGoQC2Ta4AsE2mALFNpgCWTYYAtVCuAIczdQCtS6QAkj2CAI05fQCqSp8AiTh4AKxGogCmRpoAvWK2AK1JogC3UK8AqEWdAIYzdgCHM3YAkjqDAI82fgC1S60AgjJxALVdrACkVpcAjTl+ALxgtACmQ5sAjjx+AIQ0dACcP44A/v7+AJ1QkACIM3cAqEieAI06fACzT6sAkj2EALRPqwCobJwArkumAIMycgCjXZUAizV6AKFDlACzSqkAkTiCALZRrgCVP4cAmDuKALNNqQCGN3UAhzd1AKpFnwCqV54AkzqFAJQ6hQCwSKcAsFqmALRPrAC1T6wAgzJzAJs9jQCUPYUAhDJzAKFDlQCQPIAAt1GvAKhGnQC5X7EAo1SXAK9JpQCYPosAhzd2AI83fgCIN3YAtkytAIk2eQCLOXkAsU6oALdRsAC4UbAAqUaeAJM7hACwSaYAiDd3AJo+jAC2TK4AlEyGAJlBjACJNnoAvWG1AIYydQCLOXoA////ALJOqQC1SqwAuFGxAI04fQCfP5IAo0aXAI07fQD9/f0AokGVAJ1AkACjZJYAs06qAJhOigD7+/sAnEOQAKRDmACDMXEAm0qNAI07fgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQEBAQEBAQEBAQEBAQEBAQEBbYA1W0tPLFpwIi8PAQEBK1JxQENGeDAgAipsYUIBATI+hBopTVN8JRQAdRVhAQFvJhKCczR7e3MfCE4LFQEBBAcngnM/DIWCNB9KaQsBAV0oCYJzGFU2X3MfBmdcAQFBM0yCcwp+PII0a2t8WQEBN4N9gnOBBQVzH3doE1YBAT0jIYJzDh1ignMxLlRuAQF/RxuCcy0Reg1zHx+GOgEBGSQ5gnNzNDRzHx9JHzgBAVB2ZRAQEBAQEBxjXklqAQFkJHZmURceeYJFV3JgSAEBAXQDWEQ7Fh55gkVXcgEBAQEBAQEBAQEBAQEBAQEBAf//AADAAwAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAwAMAAP//AAA="
        rel="icon" type="image/x-icon" />
    @toastr_css
    @yield('styles')
</head>

<body class="sb-nav-fixed">
    <div id="app">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-sm p-2">
            <a class="navbar-brand" href="{{ route('managers.home') }}">Manager Challenge</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::guard('manager')->user()->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('managers.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('managers.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link collapsed" href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                Drivers
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::guard('manager')->user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Challenge 2021
                            </div>
                        </div>
                </footer>
            </div>
        </div>
    </div>

    @jquery
    @toastr_js
    @toastr_render
    <script src="{{ mix('js/managers.js') }}"></script>
    @yield('scripts')
</body>

</html>
