<template>
  <div>
    <div class="codegolf-header">
      <a :href="location">
        <img src="../assets/codegolf_logo.png" class="codegolf-logo">
      </a>
    </div>
    <div v-if="!loggedIn.val">
      <div style="position: fixed;z-index: 100; float: right; right:0;">
        <button class="codegolf-login-register-button" onclick="Register()" style="margin-right: 5px;">register</button>
        <button class="codegolf-login-register-button" onclick="Login()">login</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['loggedIn'],
  name: 'Header',
  data() {
    return {
      location: window.location.protocol
    }
  }
}
</script>

<style scoped>
.codegolf-header {
  width: 100%;
  height: 50px;
  position: fixed;
  z-index: 10;
  background: #000c;
  font-size: 24px;
}

.codegolf-logo {
  width: 220px;
  padding: 3px;
  float: left;
  position: absolute;
}

.codegolf-login-register-button {
  position: relative;
  z-index: 30;
  top: 46%;
  border: 0;
  font-size: 18px;
  width: 80px;
  height: 40px;
  margin-top: 4px;
  background: #488a;
  padding: 5px;
  color: #fff;
  float: right;
  margin-right: 5px;
  cursor: pointer;
}

.codegolf-sitename {
  margin-top: 5px;
  width: 200px;
  font-size: 20px;
  float: left;
  color: #fff;
}
</style>
