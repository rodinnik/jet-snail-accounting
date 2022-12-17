<template>
  <v-app>
    <v-app-bar
      color="teal-darken-4"
      image="https://picsum.photos/1920/1080?random"
    >
      <template v-slot:image>
        <v-img
          gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
        ></v-img>
      </template>

      <v-app-bar-title @click="$router.push('/')"
        >Учет техники “Реактивная Улитка”</v-app-bar-title
      >

      <v-spacer></v-spacer>
      <template v-if="$store.getters.isLoggedIn">
        <v-btn @click="$router.push('/accounting')"
          >Панель редактирования учета</v-btn
        >
        <v-btn @click="logout()">Выйти</v-btn></template
      >
      <template v-else>
        <v-btn @click="$router.push('/login')">Войти</v-btn>
        <v-btn @click="$router.push('/register')"
          >Зарегистрироваться</v-btn
        ></template
      >
    </v-app-bar>

    <v-main>
      <v-container fluid> <router-view></router-view></v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store
        .dispatch("logout")
        .then(() => this.$router.push("/login"))
        .catch((error) => console.log(error));
    },
  },
};
</script>