<template>
<div class="login-container w-screen h-screen flex flex-col items-center justify-center overflow-hidden">
  <div class="max-w-xl mb-8 flex justify-center">
    <img class="block h-24 self-start" src="/images/logo-new.svg">
  </div>
  <div class="max-w-xl flex shadow-md">
    <div class="bg-purple-darkest rounded rounded-l w-1/2 text-center overflow-hidden p-6 flex">
      <img class="block self-center" src="/images/auth-graphic.svg">
    </div>
    <div class="bg-white rounded rounded-r p-8 flex flex-col align-center justify-center w-1/2 text-center">
      <transition name="auth" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</div>
</template>
<script>
export default {
  name: 'Auth'
}
</script>

<style lang="scss">
.auth-enter-active,
.auth-leave-active {
  transition: opacity 250ms ease, transform 250ms ease;
}
.auth-enter,
.auth-leave-to {
  opacity: 0;
  transform: translate3d(0, -10px, 0);
}
</style>

