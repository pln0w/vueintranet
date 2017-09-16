<template>
  <ul class="sidebar-menu">

    <li class="header">Workflow</li>

    <li class="active pageLink" v-on:click="toggleMenu">
      <router-link to="/"><i class="fa fa-desktop"></i>
        <span class="page">Dashboard</span>
      </router-link>
    </li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/jira">
        <i class="fa fa-table"></i>
        <span class="page">JIRA</span>
      </router-link>
    </li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/projects"><i class="fa fa-calendar"></i>
        <span class="page">Projects</span>
      </router-link>
    </li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/websites"><i class="fa fa-sitemap"></i>
        <span class="page">Websites</span>
      </router-link>
    </li>


    <li class="header">Human resources</li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/users">
        <i class="fa fa-users"></i>
        <span class="page">Users</span>
      </router-link>
    </li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/events">
        <i class="fa fa-calendar"></i>
        <span class="page">Events</span>
      </router-link>
    </li>


    <li class="header">Infrastructure</li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/servers"><i class="fa fa-hdd-o"></i>
        <span class="page">Servers</span>
      </router-link>
    </li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/vms"><i class="fa fa-hdd-o"></i>
        <span class="page">Vms</span>
      </router-link>
    </li>

    <li class="header">Application</li>

    <li class="pageLink" v-on:click="toggleMenu">
      <router-link to="/login">
        <i class="fa fa-circle-o text-yellow"></i>
        <span class="page"> Login</span>
      </router-link>
    </li>
    <li class="pageLink" v-on:click="logoutMe">
      <router-link to="#"><i class="fa fa-circle-o text-red"></i>
        <span class="page"> Logout</span>
      </router-link>
    </li>

  </ul>
</template>
<script>

  import api from '../api'

  export default {
    name: 'SidebarName',
    methods: {
      toggleMenu (event) {
        // remove active from li
        var active = document.querySelector('li.pageLink.active')

        if (active) {
          active.classList.remove('active')
        }
        // window.$('li.pageLink.active').removeClass('active')
        // Add it to the item that was clicked
        event.toElement.parentElement.className = 'pageLink active'
      },
      logoutMe () {
        api.request('get', '/api/logout', {}).then(response => {
          this.$store.commit('TOGGLE_LOADING')
          var data = response.data

          /* Checking if error object was returned from the server */
          if (data.error) {
            var message = data.error.message
            if (message) {
              this.response = message
            } else {
              this.response = data.error
            }
            return
          }
        }).catch(error => {
          console.log(error)
          this.$store.commit('TOGGLE_LOADING')
          this.response = 'Server appears to be offline'
          this.toggleLoading()
        })

        /* This is todo. Should use App.vue logout() */
        /* For now it is a copy of that method */
        this.$store.commit('SET_USER', null)
        this.$store.commit('SET_TOKEN', null)

        if (window.localStorage) {
          window.localStorage.setItem('user', null)
          window.localStorage.setItem('token', null)
        }

        this.$router.push('/login')
      }
    }
  }
</script>
<style>
  /* override default */
  .sidebar-menu > li > a {
    padding: 12px 15px 12px 15px;
  }

  .sidebar-menu li.active > a > .fa-angle-left, .sidebar-menu li.active > a > .pull-right-container > .fa-angle-left {
    animation-name: rotate;
    animation-duration: .2s;
    animation-fill-mode: forwards;
  }

  @keyframes rotate {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(-90deg);
    }
  }
</style>
