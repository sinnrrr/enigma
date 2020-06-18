<template>
  <section class="index">
    <h1>Lost and found of the future</h1>
    <div class="center content-inputs">
        <vs-input v-model="searchValue" placeholder="Search" />
    </div>
  </section>
</template>

<script>

export default {
  data: () => ({
    searchValue: ''
  })
}
</script>

<style scoped>
  section.index {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 30px;
    background-color: rgb(var(--vs-warn));
    height: 90vh;
  }

  div.content-inputs {
    margin-top: 15px;
  }

  h1 {
    font-weight: 700;
    font-size: 32px;
  }
</style>
