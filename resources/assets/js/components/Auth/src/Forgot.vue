<template>
  <div class="login-form w-3/4 mx-auto">
    <h3 class="text-brand text-2xl">Forgot your password?</h3>
    <p class="my-2 text-grey-dark">No problem! Enter your email below and we'll send you a link to reset your password.</p>
    <form class="my-6">
      <TextField name="email" class="mb-4" type="email" placeholder="Email Address" v-model="email"></TextField>
      <button type="submit" class="auth-button w-full h-10 bg-brand hover:bg-purple text-white rounded">Send Recovery Email</button>
    </form>
    <div class="rounded bg-grey-lighter p-2 text-sm text-black">All good? <router-link to="/auth/login" class="font-semibold text-brand hover:text-purple no-underline">Sign in!</router-link></div>
  </div>
</template>
<script>
import TextField from "./TextField"
export default {
  name: "Forgot",
  components: {
    TextField
  },
  data() {
    return {
      email: ""
    }
  }
}
</script>
<style lang="scss" scoped>
.auth-button {
  transition: background 150ms ease;
}
</style>

