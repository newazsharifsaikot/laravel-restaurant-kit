<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
            Mama's Kitchen
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{Request::is('admin/dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/slider*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.slider')}}">
                    <i class="material-icons">slideshow</i>
                    <p>Slider</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/category*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.category')}}">
                    <i class="material-icons">category</i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/item*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.item')}}">
                    <i class="material-icons">menu_book</i>
                    <p>Item</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/reservation*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.reservation')}}">
                    <i class="material-icons">weekend</i>
                    <p>Reservation</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/contact*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.contact')}}">
                    <i class="material-icons">contact_support</i>
                    <p>Contact</p>
                </a>
            </li>
            <hr>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="material-icons">login</i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>
