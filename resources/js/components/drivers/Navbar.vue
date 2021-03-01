<template>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-sm p-2">
    <a class="navbar-brand" href="/drivers/home">Drivers Challenge</a>
    <button
      class="btn btn-link btn-sm order-1 order-lg-0"
      id="sidebarToggle"
      href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          id="userDropdown"
          href="#"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          User</a
        >
        <div
          class="dropdown-menu dropdown-menu-right"
          aria-labelledby="navbarDropdown"
        >
          <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
      
        </div>
      </li>
    </ul>
  </nav>
</template>
<script>
export default {
  
        methods:{
            logout:function(){
               axios.post('/api/drivers/logout').then(response => {
                  if (response.status === 302 || 401) {
                    location.reload();
                  }
                  else {
                    // throw error and go to catch block
                  }
                }).catch(error => {

              });
            },
        },
    }
</script>
