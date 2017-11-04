<template>
  <div class="login-form w-3/4 mx-auto">
    <h3 class="text-brand text-2xl">Welcome to GameReel</h3>
    <p class="my-2 text-grey-dark">GameReel is the best way to organize your collection of Xbox clips. Sign up below to get started. It's free!</p>
    <form class="my-6">
      <TextField name="gamertag" class="mb-4" type="text" placeholder="Xbox Gamertag" v-model="user.gamertag"></TextField>
      <TextField name="email" class="mb-4" type="email" placeholder="Email Address" v-model="user.email"></TextField>
      <TextField name="password" class="mb-4" type="password" placeholder="Password" v-model="user.password"></TextField>
      <TextField name="password_confirmation" class="mb-4" type="password" placeholder="Password Confirmation" v-model="user.password_confirmation"></TextField>
      <button type="submit" class="auth-button w-full h-10 bg-brand hover:bg-purple text-white rounded">Sign Up</button>
    </form>
    <div class="rounded bg-grey-lighter p-2 text-sm text-black">Already have an account? <router-link to="/auth/login" class="font-semibold text-brand hover:text-purple no-underline">Sign in!</router-link></div>
  </div>
</template>
<script>
import TextField from "./TextField"
export default {
  name: "Register",
  components: {
    TextField
  },
  data() {
    return {
      user: {
        email: "",
        password: "",
        password_confirmation: "",
        gamertag: ""
      }
    }
  }
}
</script>
<style lang="scss" scoped>
.auth-button {
  transition: background 150ms ease;
}
</style>

