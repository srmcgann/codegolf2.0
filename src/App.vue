<template>
  <div id="app">
    <div v-html="menuHTML"/>
    <Header :logged-in="loggedIn"/>
    <Sidebar :logged-in="loggedIn"/>
    <AppletList/>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Sidebar from './components/Sidebar.vue'
import AppletList from './components/AppletList.vue'

export default {
  name: 'app',
  components: {
    Header,
    Sidebar,
    AppletList
  },
  data () {
    return {
      menuHTML: '',
      loggedIn: {val: false}
    }
  },
}
</script>

<style>
@import './assets/css/style.css';
</style>
