<template>
  <div class="login-form w-3/4 mx-auto">
    <h3 class="text-brand text-2xl">Welcome to GameReel</h3>
    <p class="my-2 text-grey-dark leading-normal">GameReel is the best way to organize your collection of Xbox clips. Sign up below to get started. It's free!</p>
    <ul class="" v-show="errors.length" class="bg-red rounded text-sm m-0 mx-0 mb-0 mt-4 p-2 list-none">
      <li v-for="(error, index) in errors" :key="index" class="text-white p-2">
        {{ error }}
      </li>
    </ul>
    <form class="my-6" @submit.prevent="registerUser(user)">
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
import { mapActions } from 'vuex'
import { flattenErrors } from '@/lib/errors'
import TextField from './TextField'
export default {
  name: 'Register',
  components: {
    TextField
  },
  data() {
    return {
      user: {
        email: '',
        password: '',
        password_confirmation: '',
        gamertag: ''
      },
      errors: []
    }
  },
  methods: {
    ...mapActions(['register']),
    registerUser(user) {
      this.register(user)
        .then(res => {
          this.errors = []
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

