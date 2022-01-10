<template>
    <div class="notification" v-text="message"></div>
</template>

<script>
export default {
  props: ['message']
}
</script>

<style lang="css" scoped>
.notification{
    border:solid 1px brown;
}
</style>