<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html"> <img alt="image" src="{{ asset('admin-assets/img/logo.png') }}" class="header-logo" /> <span
            class="logo-name">Survey</span>
        </a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i
              data-feather="briefcase"></i><span>Survey</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.home.list') }}">Survey List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Category</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.Category.create') }}">Create Category</a></li>
            <li><a class="nav-link" href="{{ route('admin.Category.list') }}">Category List</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Survey</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('admin.Survey.create') }}">Create Survey</a></li>
          </ul>
        </li>
      </ul>
    </aside>
  </div>