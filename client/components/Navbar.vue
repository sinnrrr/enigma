<template>
  <header>
    <div>
      <vs-button flat warn active><span class="logo">Enigma</span></vs-button>
    </div>
    <nav>
      <vs-button warn><span class="nav-item">About</span></vs-button>
      <vs-button warn><span class="nav-item">Office</span></vs-button>
      <vs-button warn><span class="nav-item">Sign in</span></vs-button>
      <vs-button dark border :active="active === 1" @click="active === 1 ? 0 : 1">
        <span class="nav-item">Sign up</span>
      </vs-button>
      <vs-button>Hello</vs-button>
    </nav>
  </header>
</template>

<script>
    export default {
        name: "Navbar",
      data: () => ({
          active: 0
      })
    }
</script>

<style scoped>
  header {
    display: flex;
    padding: 5px 15px;
    justify-content: space-between;
    align-items: center;
    background-color: rgb(var(--vs-warn));
    height: 10vh;
  }

  nav {
    display: inline-flex;
  }

  span.logo {
    font-weight: 900;
    font-size: 32px;
  }

  span.nav-item {
    font-weight: 700;
    font-size: 18px;
  }
</style>
