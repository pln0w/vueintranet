<template>
  <div :class="['wrapper', classes]">
    <header class="main-header">
      <a href="/" class="logo">
        <!-- mini logo for sidebar mini 40x50 pixels -->
        <span class="logo-mini"><img src="/static/img/copilot-logo-white.svg" alt="Logo"
                                     class="img-responsive center-block"></span>
        <!-- logo for regular state and mobile devices -->
        <div class="logo-lg">
          <img src="/static/img/copilot-logo-white.svg" alt="Logo" class="img-responsive">
          <span>Intranet</span>
        </div>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages-->
            <li class="dropdown messages-menu">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">{{ userInfo.messages | count }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have {{ userInfo.messages | count }} message(s)</li>
                <li v-if="userInfo.messages.length > 0">
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li v-for="(item, index) in userInfo.messages"><!-- start message -->
                      <a href="javascript:;">
                        <!-- Message title and timestamp -->
                        <h4>
                          {{ item.title }}
                          <small><i class="fa fa-clock-o"></i> {{ index }}</small>
                        </h4>
                        <!-- The message -->
                        <p>{{ item.message }}</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer" v-if="userInfo.messages.length > 0"><a href="javascript:;">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">{{ userInfo.notifications | count }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have {{ userInfo.notifications | count }} notification(s)</li>
                <li v-if="userInfo.notifications.length > 0">
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="javascript:;">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer" v-if="userInfo.notifications.length > 0"><a href="javascript:;">View all</a></li>
              </ul>
            </li>

            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">{{ userInfo.tasks | count }} </span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have {{ userInfo.tasks | count }}  task(s)</li>
                <li v-if="userInfo.tasks.length > 0">
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li v-for="task in userInfo.tasks"><!-- Task item -->
                      <a href="javascript:;">
                        <!-- Task title and progress text -->
                        <h3>
                          <strong>{{ task.status }}</strong>: {{ task.title }}
                          <small class="pull-right">{{ task.value }}%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua"
                               :style="taskProgress(task)"
                               role="progressbar"
                               :aria-valuenow="task.value"
                               aria-valuemin="0"
                               aria-valuemax="100">
                            <span class="sr-only">{{ task.value }}% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer" v-if="userInfo.tasks.length > 0">
                  <a href="javascript:;">View all tasks</a>
                </li>
              </ul>
            </li>

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img v-bind:src="currentUser.avatar" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ currentUser.displayName }}</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <sidebar :display-name="currentUser.displayName"
             :picture-url="currentUser.avatar"/>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$route.name.toUpperCase() }}
          <small>{{ $route.meta.description }}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="javascript:;"><i class="fa fa-home"></i>Home</a></li>
          <li class="active">{{$route.name.toUpperCase()}}</li>
        </ol>
      </section>

      <router-view></router-view>

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{year}} <a href="javascript:;"></a>.</strong> All rights reserved.
    </footer>

  </div>
  <!-- ./wrapper -->

</template>

<script>
  import {mapState} from 'vuex'
  import config from '../config'
  import Sidebar from './Sidebar'
  import store from '../store'
  import 'hideseek'

  export default {
    name: 'Dash',
    components: {
      Sidebar
    },
    data: function () {
      return {
        // section: 'Dash',
        year: new Date().getFullYear(),
        classes: {
          fixed_layout: config.fixedLayout,
          hide_logo: config.hideLogoOnMobile
        },
        error: ''
      }
    },
    computed: {
      ...mapState([
        'userInfo'
      ]),
      currentUser () {
        return {
          displayName: store.state.user.first_name,
          avatar: store.state.user.image,
          email: store.state.user.email
        }
      }
    },
    methods: {
      changeloading () {
        this.$store.commit('TOGGLE_SEARCHING')
      },
      taskProgress (task) {
        return 'width: ' + task.value + '%'
      }
    }
  }
</script>

<style lang="scss">
  .wrapper.fixed_layout {
    .main-header {
      position: fixed;
      width: 100%;
    }

    .content-wrapper {
      padding-top: 50px;
    }

    .main-sidebar {
      position: fixed;
      height: 100vh;
    }
  }

  .wrapper.hide_logo {
    @media (max-width: 767px) {
      .main-header .logo {
        display: none;
      }
    }
  }

  .logo-mini, .logo-lg {
    text-align: left;

    img {
      padding: .4em;
    }
  }

  .logo-lg {
    img {
      display: -webkit-inline-box;
      width: 25%;
    }
  }

  .user-panel {
    height: 4em;
  }

  hr.visible-xs-block {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.17);
    height: 1px;
    border-color: transparent;
  }

  footer {
    height: 50px;
  }

  .height-50 {
    height: 50px;
  }

  .info-box-text {
    font-size: 20px;
  }
  .info-box-number {
    font-size: 30px;
  }
</style>
