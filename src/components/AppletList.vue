<template>
  <div class="codegolf-applet-list" id="main"/>
</template>

<script>
export default {
  name: 'AppletList',
}
</script>

<style>
@import '../assets/codemirror_themes/codemirror.css';
@import '../assets/codemirror_themes/blackboard.css';
</style>

<style scoped>
.codegolf-applet-list {
  width: calc(100% - 300px);
  margin-left: 300px;
  overflow-y: auto;
  text-align: center;
}

@media screen and (max-width: 1000px) {
  .codegolf-applet-list {
    margin-left: 0;
    width: 100%;
  }
}
</style>
