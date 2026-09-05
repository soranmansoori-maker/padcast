<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"
               aria-expanded="false"></a>
            <a href="#" onClick="return false;" class="bars"></a>
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img width="30" height="30" src="/assets/images/vijegan_logo.png" alt="academy logo"/>
                <span class="logo-name">داشبورد کاربران</span>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" onClick="return false;" class="sidemenu-collapse">
                        <i class="nav-hdr-btn ti-align-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Full Screen Button -->
                <li class="fullscreen">
                    <a href="javascript:;" class="fullscreen-btn">
                        <i class="nav-hdr-btn ti-fullscreen"></i>
                    </a>
                </li>
                <!-- #END# Full Screen Button -->
                <li class="dropdown user_profile" style="cursor: pointer">
                    <div class="dropdown-toggle" data-toggle="dropdown">
                        <img height="35" width="35"
                             src="{{ Auth::user()->picture != NULL ? Auth::user()->picture : '/assets/images/no-avatar.png' }}"
                             alt="user">
                    </div>
                    <ul class="dropdown-menu pullDown">
                        <li class="body">
                            <ul class="user_dw_menu">
                                <li>
                                    <a href="{{ route('profile.index') }}">
                                        <i class="material-icons">person</i>پروفایل
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onClick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">power_settings_new</i>{{ __('auth.Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- #END# Tasks -->
                <li class="pull-right">
                    <a href="#" onClick="return false;" class="js-right-sidebar" data-close="true">
                        <i class="nav-hdr-btn ti-layout-grid2"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<div>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="sidebar-profile clearfix">
                        <div class="profile-img">
                            <img src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" alt="profile">
                        </div>
                        <div class="profile-info">
                            <h3>{{ auth()->user()->name }}</h3>
                            <p>خوش آمدید !</p>
                        </div>
                    </div>
                </li>
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="menu-icon ti-home"></i>
                        <span>داشبورد</span>
                    </a>
                </li>
                <li class="{{ request()->is('dashboard/podcast*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon  ti-microphone"></i>
                        <span>مدیریت پادکست ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('dashboard/podcast/create') ? 'active' : '' }}">
                            <a href="{{ route('podcast.create') }}">افزودن پادکست جدید</a>
                        </li>
                        <li class="{{ request()->is('dashboard/podcast') ? 'active' : '' }}">
                            <a href="{{ route('podcast.index') }}">لیست پادکست ها</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('dashboard/album*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-layers-alt"></i>
                        <span>مدیریت آلبوم ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('dashboard/album/create') ? 'active' : '' }}">
                            <a href="{{ route('album.create') }}">افزودن آلبوم جدید</a>
                        </li>
                        <li class="{{ request()->is('dashboard/album') ? 'active' : '' }}">
                            <a href="{{ route('album.index') }}">لیست آلبوم ها</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('dashboard/profile*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-settings"></i>
                        <span>مدیریت پروفایل</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('dashboard/profile') ? 'active' : '' }}">
                            <a href="{{ route('profile.index') }}">تنظیمات پروفایل</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <hr>
                    <div class="leftSideProgress">
                        <div class="progress-list">
                            <div class="details">
                                <div class="title">استفاده از دیسک</div>
                            </div>
                            <div class="status">
                                <span>{{ $diskSize ?? '' }}</span>
                            </div>
                            <div class="progress-s progress">
                                <div class="progress-bar progress-bar-success width-per-{{ $diskSize[0] ?? '' }}" role="progressbar"
                                     aria-valuenow="10" aria-valuemin="10" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leftSideProgress">
                        <div class="progress-list m-b-10">
                            <div class="details">
                                <div class="title">دانلود پادکست</div>
                            </div>
                            <div class="status">
                                <span>{{ $downloads ?? '0' }} بار</span>
                            </div>
                            <div class="progress-s progress">
                                <div class="progress-bar progress-bar-info width-per-100" role="progressbar"
                                     aria-valuenow="100" aria-valuemin="100" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation">
                <a href="#skins" data-toggle="tab" class="active">پوسته ها</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active stretchLeft" id="skins">
                <div class="demo-skin">
                    <div class="rightSetting">
                        <p>رنگ منو نوار کناری</p>
                        <button type="button" class="btn btn-sidebar-light btn-border-radius p-l-20 p-r-20">روشن</button>
                        <button type="button" class="btn btn-sidebar-dark btn-default btn-border-radius p-l-20 p-r-20">تاریک</button>
                    </div>
                    <div class="rightSetting">
                        <p>رنگ قالب</p>
                        <button type="button" class="btn btn-theme-light btn-border-radius p-l-20 p-r-20">روشن</button>
                        <button type="button" class="btn btn-theme-dark btn-default btn-border-radius p-l-20 p-r-20">تاریک</button>
                    </div>
                    <div class="rightSetting">
                        <p>پوسته ها</p>
                        <ul class="demo-choose-skin choose-theme list-unstyled">
                            <li data-theme="black" class="actived">
                                <div class="black-theme"></div>
                            </li>
                            <li data-theme="white">
                                <div class="white-theme white-theme-border"></div>
                            </li>
                            <li data-theme="purple">
                                <div class="purple-theme"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue-theme"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan-theme"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green-theme"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange-theme"></div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</div>
