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
                <a class="navbar-brand d-flex align-items-center" href="{{ route('admin-dashboard') }}" style="text-decoration:none;color:inherit;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-left:8px;">
                        <path d="M3 12C7 6 11 6 15 12C19 18 23 18 23 18" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="7" cy="7" r="1.5" fill="#000000"/>
                    </svg>
                    <span style="font-weight:700;margin-right:8px;">WaveCast</span>
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
                        <img src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" width="35" height="35" alt="user">
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
                <li class="{{ request()->is('administrator') ? 'active' : '' }}">
                    <a href="{{ route('admin-dashboard') }}">
                        <i class="menu-icon ti-home"></i>
                        <span>داشبورد مدیریت</span>
                    </a>
                </li>
                <li class="{{ request()->is('administrator/podcasts*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon  ti-microphone"></i>
                        <span>مدیریت پادکست ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/podcasts') ? 'active' : '' }}">
                            <a href="{{ route('podcasts.index') }}">لیست کل پادکست ها</a>
                        </li>
                        <li class="{{ request()->is('administrator/podcasts/requests') ? 'active' : '' }}">
                            <a href="{{ route('podcasts.show', 'requests') }}">پادکست های منتظر تایید </a>
                        </li>
                        <li class="{{ request()->is('administrator/podcasts/create') ? 'active' : '' }}">
                            <a href="{{ route('podcasts.create') }}">افزودن پادکست جدید</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrator/albums*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-layers-alt"></i>
                        <span>مدیریت آلبوم ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/albums') ? 'active' : '' }}">
                            <a href="{{ route('albums.index') }}">لیست کل آلبوم ها</a>
                        </li>
                        <li class="{{ request()->is('administrator/albums/create') ? 'active' : '' }}">
                            <a href="{{ route('albums.create') }}">افزودن آلبوم جدید</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrator/categories*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-menu-alt"></i>
                        <span>مدیریت دسته بندی ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/categories') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">لیست کل دسته بندی ها</a>
                        </li>
                        <li class="{{ request()->is('administrator/categories/create') ? 'active' : '' }}">
                            <a href="{{ route('categories.create') }}">افزودن دسته بندی جدید</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrator/users*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-user"></i>
                        <span>مدیریت کاربران</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/users') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}">لیست کل کاربران</a>
                        </li>
                        <li class="{{ request()->is('administrator/users/create') ? 'active' : '' }}">
                            <a href="{{ route('users.create') }}">افزودن کاربر جدید</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrator/comments*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon  ti-comment"></i>
                        <span>مدیریت کامنت ها</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/comments') ? 'active' : '' }}">
                            <a href="{{ route('comments.index') }}">لیست کل کامنت ها</a>
                        </li>
                        <li class="{{ request()->is('administrator/comments/requests') ? 'active' : '' }}">
                            <a href="{{ route('comments.show', 'requests') }}">کامنت های منتظر تایید </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('administrator/profile-setting*') ? 'active' : '' }}">
                    <a href="#" onClick="return false;" class="menu-toggle">
                        <i class="menu-icon ti-settings"></i>
                        <span>مدیریت پروفایل</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('administrator/profile-setting') ? 'active' : '' }}">
                            <a href="{{ route('profile-setting.index') }}">تنظیمات پروفایل</a>
                        </li>
                    </ul>
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
