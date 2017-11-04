<template>
<div class="relative">
  <input
    :type="type"
    :name="name"
    :placeholder="placeholder"
    :value="value"
    @input="onInput"
    class="login-field w-full border-2 border-grey-light h-10 px-3 bg-white rounded"
  />
</div>
</template>
<script>
export default {
  props: [
    "type",
    "placeholder",
    "name",
    "value"
  ],
  methods: {
    onInput (e) {
      this.$emit('input', e.target.value)
    }
  }
}
</script>
<style lang="scss">
.login-field {
  transition: border-color 150ms ease;
  &:focus {
    outline: none;
    border-color: config("colors.brand");
  }
}
</style>


