<template>
  <div class="modal">
    <div
      class="modal-overlay"
      @click="hideModal"
    />
    <div class="modal-content" :class="size">
      <fa icon="times" class="icon" @click="hideModal" />
      <slot />
    </div>
  </div>
</template>

<script>

export default {
  name: 'Modal',

  props: {
    size: {
      type: String,
      default: 'medium'
    }
  },

  methods: {
    hideModal () {
      this.$emit('onclose')
    }
  }
}
</script>
