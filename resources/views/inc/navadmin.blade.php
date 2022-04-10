<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="../admin/home">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="medicinelist">Medicine</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('order.list')}}">Order List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('registration')}}">Add admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="slidelist">Manage Slide</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cuponslist">Coupons</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Changepass">Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">LOG OUT</a>
      </li>
    </ul>
  </div>
</nav>