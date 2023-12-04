<template>
  <button :disabled="isDisabled" type="submit" class="submit">
    <template v-if="isLoading">
      <LoadingComponent />
    </template>
    <template v-else>
      {{ buttonText }}
    </template>
  </button>
</template>

<script>
import LoadingComponent from './LoadingComponent.vue';

export default {
  props: {
    isLoading: {
      type: Boolean,
      default: false,
    },
    isSubmitting: {
      type: Boolean,
      default: false,
    },
    buttonText: {
      type: String,
      default: 'Login',
    },
  },
    components: {
      LoadingComponent,
    },
  computed: {
    isDisabled() {
      return this.isLoading || this.isSubmitting;
    },
  },
};
</script>