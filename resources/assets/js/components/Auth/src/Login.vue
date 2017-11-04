<template>
  <div class="login-form w-3/4 mx-auto">
    <h3 class="text-brand text-2xl">Welcome Back to GameReel</h3>
    <form class="my-6">
      <TextField name="email" class="mb-4" type="email" placeholder="Email Address" v-model="user.email"></TextField>
      <TextField name="password" class="mb-1" type="password" placeholder="Password" v-model="user.password"></TextField>
      <div class="text-right mb-4"><router-link to="/auth/forgot" class="font-semibold text-brand hover:text-purple no-underline text-sm">Forgot?</router-link></div>
      <button type="submit" class="auth-button w-full h-10 bg-brand hover:bg-purple text-white rounded">Sign In</button>
    </form>
    <div class="rounded bg-grey-lighter p-2 text-sm text-black">New to GameReel? <router-link to="/auth/register" class="font-semibold text-brand hover:text-purple no-underline">Sign up!</router-link></div>
  </div>
</template>
<script>
import TextField from "./TextField"
export default {
  name: "Login",
  components: {
    TextField
  },
  data() {
    return {
      user: {
        email: "",
        password: ""
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

