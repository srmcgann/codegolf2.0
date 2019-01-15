<template>
  <div class="codegolf-sidebar">
    <div class="codegolf-sidebar-wrapper">
      <div class="codegolf-loggedInUser" v-html="menuHTML"/>
      <div class="codegolf-sidebar-content">
        <div class="codegolf-stats-container">
          <div v-html="stats"/>
        </div>
      </div>
    </div>
    <div class="codegolf-circle-wrapper">
      <div class="codegolf-connector"/>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Sidebar',
  props: ['loggedIn'],
  data () {
    return {
      stats: '',
      menuHTML: ''
    }
  },
  methods: {
    runScripts(text) {
      this.$nextTick(() => {
        let scripts = []
        do{
          let end = text.indexOf('</' + 'script>')
          scripts.push(text.substring(text.indexOf('<script>') + 8, end))
          text = text.substring(end + 9)
        }while(text.indexOf('<script>') !== -1)
        eval(scripts.join(';'))
      })
    }
  },
  mounted() {
    fetch('stats.php').then(j => j.text()).then(text => {
      this.stats = text
    })
    let filter = window.location.pathname.split('/')[1]
    let key = ''
    let email = ''
    if ( getUrlVars()['k'] ) {
      key = getUrlVars()['k'];
      email = getUrlVars()['email']
    }
    fetch('drawMenu.php?params=' + filter + '&k=' + key + '&email=' + email).then(res => res.text()).then(text => {
      this.menuHTML = text
      if(text.indexOf('preferencesScreen') !== -1) this.loggedIn.val = true;
      this.runScripts(text)
    })
  }
}
</script>

<style scoped>
hr {
  margin-top: 20px;
  margin-bottom: 20px;
}
.codegolf-sidebar {
  position: fixed;
  z-index: 10;
  width: 300px;
  top: 50px;
  height: calc(100vh - 30px);
  background: #000c;
  text-align: center;
  font-size: 16px;
}

.codegolf-circle-wrapper {
  overflow: hidden;
  width: 50px;
  height: 50px;
  left: 300px;
  top: 0;
  background-color: transparent;
  position: absolute;
  box-sizing: border-box;
  display: block;
}

.codegolf-connector {
  left: -30px;
  top: -30px;
  border-radius: 50%;
  border: 30px solid #000c;
  width: 160px;
  height: 160px;
  position: absolute;
  box-sizing: border-box;
  display: block;
}

.codegolf-sidebar-wrapper{
  height: 100%;
  overflow-Y: auto;
}

.codegolf-sidebar-content {
  padding-top: 10px;
  padding-bottom: 10px;
  display: block;
}

.codegolf-stats-container {
  display: blaock;
}

@media screen and (max-width: 1000px) {
  .codegolf-sidebar {
    width: 100%;
    height: 0;
  }

  .codegolf-sidebar:hr {
    display: none;
  }

  .codegolf-sidebar-content {
    display: none;
  }
  
  .codegolf-sidebar-wrapper{
    position: relative;
    top: 0;
    transform: none;
  }

  .codegolf-circle-wrapper {
    display: none;
  }

  .codegolf-stats-container {
    display: none;
  }
}
</style>
