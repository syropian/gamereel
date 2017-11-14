<template>
  <div class="login-form w-3/4 mx-auto">
    <h3 class="text-brand text-2xl">Welcome Back to GameReel</h3>
    <ul class="" v-show="errors.length" class="bg-red rounded text-sm m-0 mx-0 mb-0 mt-4 p-2 list-none">
      <li v-for="(error, index) in errors" :key="index" class="text-white p-2">
        {{ error }}
      </li>
    </ul>
    <form class="my-6" @submit.prevent="loginUser(user)">
      <TextField name="email" class="mb-4" type="email" placeholder="Email Address" v-model="user.email"></TextField>
      <TextField name="password" class="mb-1" type="password" placeholder="Password" v-model="user.password"></TextField>
      <div class="text-right mb-4"><router-link to="/auth/forgot" class="font-semibold text-brand hover:text-purple no-underline text-sm">Forgot?</router-link></div>
      <button type="submit" class="auth-button w-full h-10 bg-brand hover:bg-purple text-white rounded">Sign In</button>
    </form>
    <div class="rounded bg-grey-lighter p-2 text-sm text-black">New to GameReel? <router-link to="/auth/register" class="font-semibold text-brand hover:text-purple no-underline">Sign up!</router-link></div>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
import { flattenErrors } from '@/lib/errors'
import TextField from './TextField'
export default {
  name: 'Login',
  components: {
    TextField
  },
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      errors: []
    }
  },
  methods: {
    ...mapActions(['login']),
    loginUser(user) {
      this.login(user)
        .then(res => {
          this.errors = []
          this.$router.push('/dashboard')
        })
        .catch(err => {
          this.errors = flattenErrors(err.errors)
        })
    }
  }
}
</script>
<style lang="scss" scoped>
.auth-button {
  transition: background 150ms ease;
}
</style>

