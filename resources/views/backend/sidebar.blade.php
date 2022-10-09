<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-text mx-3">Resilient</div>
        {{--            <div class="sidebar-brand-icon">--}}
        {{--                <img src="{{ asset("admin/img/logo/logo2.png") }}">--}}
        {{--            </div>--}}

    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @can('user.index')
    
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Corporate
        </div>

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePresentation"
            aria-controls="collapsePresentation">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Results Presentations</span>
            </a>
            <div id="collapsePresentation" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="{{ url('presentations/presentation') }}">View All</a>
                    <a class="collapse-item" href="{{ url('presentations/presentation_sections') }}">Categories</a>
                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinancials"
            aria-controls="collapseFinancials">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Financials</span>
            </a>
            <div id="collapseFinancials" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    <a class="collapse-item" href="{{ url('financials/financial') }}">View All</a>
                    <a class="collapse-item" href="{{ url('financials/financial_section') }}">Categories</a>
                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDmtns"
            aria-controls="collapseDmtns">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>DMTN Programme</span>
            </a>
            <div id="collapseDmtns" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Categories</h6>
                    <a class="collapse-item" href="{{ url('dmtns/program_documents') }}">Programe Documents</a>
                    <a class="collapse-item" href="{{ url('dmtns/policies') }}">Policies</a>
                    <a class="collapse-item" href="{{ url('dmtns/price_supplements') }}">Pricing Supplements</a>
                    <a class="collapse-item" href="{{ url('dmtns/credit_ratings') }}">Credit Ratings</a>
                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('shareholders') }}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Shareholder Analysis</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('bbbees') }}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>B-BBEE</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('circulars') }}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Circulars</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('announcements') }}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Company Announcements</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('financial_performance') }}">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Financial Performance</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{url('calendar')}}">
                <i class="fas fa-fw fa-calendar"></i>
                <span> Calendar</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="{{ url('schedules_properties') }}">
                <i class="fas fa-fw fa-image"></i>
                <span>Schedule of Properties</span>
            </a>
        </li>

    @endcan
    
    
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Marketing
    </div>

    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePortfolio" aria-controls="collapsePortfolio">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Portfolio</span>
        </a>
        <div id="collapsePortfolio" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="{{ url("properties") }}">View All</a>
               
               
            </div>
        </div>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('portifolio_banners') }}">
            <i class="fas fa-fw fa-flag"></i>
            <span>Portifolio Banner</span>
        </a>
    </li>
   
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('provinces') }}">
            <i class="fas fa-fw fa-flag"></i>
            <span>Provinces</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('shop_logos') }}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Tenant Logos</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('page_banners') }}">
            <i class="fas fa-fw fa-image"></i>
            <span>Page Banners</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('galleries')}}">
            <i class="fas fa-fw fa-image"></i>
            <span>Property Galleries</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{url('years')}}">
            <i class="fas fa-fw fa-image"></i>
            <span>Years</span>
        </a>
    </li>

   

   


    @can('user.index')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Settings
        </div>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true"
            aria-controls="collapsePage">
                <i class="fas fa-fw fa-columns"></i>
                <span style="font-weight: 600;">Users</span>
            </a>
            <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                   
                    <a class="collapse-item" href="{{ url('users') }}">View All</a>
                
                </div>
            </div>
        </li>
        
    @endcan


    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
</ul>
<!-- Sidebar -->
