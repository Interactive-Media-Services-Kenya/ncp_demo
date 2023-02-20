<div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="/" class="mm-active">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    View Homepage
                                </a>
                            </li>
                            @can('user_management_access')
                            <li class="app-sidebar__heading">User Management</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-config"></i>
                                    Administration
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.users.index')}}">
                                            <i class="metismenu-icon"></i>
                                            Users
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.roles.index')}}">
                                            <i class="metismenu-icon"></i>
                                            Roles
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.permissions.index')}}">
                                            <i class="metismenu-icon"></i>
                                            Permissions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.logs.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Access Logs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-cash"></i>
                                    Companies
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.companies.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Company Listing
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.industries.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Company Categories
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Entries Management</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-diamond"></i>
                                    Entries
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.entries.validpool')}}" >
                                            <i class="metismenu-icon"></i>
                                            Valid Pool
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.entries.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            All Entries
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.entries.valid')}}" >
                                            <i class="metismenu-icon"></i>
                                            Valid Entries
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.entries.invalid')}}" >
                                            <i class="metismenu-icon"></i>
                                            Invalid Entries
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Draw Management</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-helm"></i>
                                    Draws and Winners
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.draws.create')}}" >
                                            <i class="metismenu-icon"></i>
                                            Run Draw
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.draws.create-region')}}" >
                                            <i class="metismenu-icon"></i>
                                            Regional Draw
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.weeks.create')}}" >
                                            <i class="metismenu-icon"></i>
                                            All Weekly Draws
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.draws.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            All Draws
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.entries.participants')}}" >
                                            <i class="metismenu-icon"></i>
                                            Participants
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.draw.blacklists')}}" >
                                            <i class="metismenu-icon"></i>
                                            Blacklists
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.draws.draw-winners-all')}}" >
                                            <i class="metismenu-icon"></i>
                                            Draw Winners
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.rejects.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Rejected Winners
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Merchandise Management</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-keypad"></i>
                                    Merchandises
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.products-categories.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Merchandise Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.products.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Merchandise
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.products.issued-out')}}" >
                                            <i class="metismenu-icon"></i>
                                            Issued Merchandises
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.products.remaining')}}" >
                                            <i class="metismenu-icon"></i>
                                            Remaining Merchanises
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endcan
                            <li class="app-sidebar__heading">Daily Airtime Winners</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-helm"></i>
                                    25, 50, & 100 Airtime Winners
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.airtime.all-wins')}}" >
                                            <i class="metismenu-icon"></i>
                                            All Airtime Winners
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.airtime.all-wins-25')}}" >
                                            <i class="metismenu-icon"></i>
                                            25 Airtime Wins
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.airtime.all-wins-50')}}" >
                                            <i class="metismenu-icon"></i>
                                            50 Airtime Winners
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin.airtime.all-wins-100')}}" >
                                            <i class="metismenu-icon"></i>
                                            100 Airtime Winners
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">Customer Management</li>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Customers
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('admin.complaints.index')}}" >
                                            <i class="metismenu-icon"></i>
                                            Complaints
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="app-sidebar__heading">FAQ Management</li>
                            <li>
                                <a href="{{route('admin.faqs.index')}}" >
                                    <i class="metismenu-icon pe-7s-mouse">
                                    </i>FAQs
                                </a>
                            </li>
                            <li class="app-sidebar__heading"><a  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form></li>
                        </ul>
                    </div>
                </div>
            </div>
