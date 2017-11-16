<template>
  <div id="app">
    <transition name="fade" mode="out-in" appear>
      <router-view/>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'App',
  mounted() {
    if (window.EMAIL_CONFIRMED) {
      this.$swal({
        type: 'success',
        title: 'Email Confirmed',
        text: 'Thanks! I hope you enjoy GameReel.',
        confirmButtonColor: '#794acf',
        confirmButtonText: 'Close'
      })
    }
  }
}
</script>
<style lang="scss">
#app {
  background-image: url('/images/bg.jpg');
  min-height: 100vh;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 250ms ease;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>


