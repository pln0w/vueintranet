<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    name: 'App',
    data () {
      return {
        section: 'Head'
      }
    }
  }
</script>

<style lang="scss">
  #app {
    height: 100%;
  }
</style>
