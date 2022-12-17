<template>
  <v-form>
    <v-text-field v-model="user.email" label="email" required></v-text-field>
    <v-text-field
      v-model="user.password"
      label="password"
      required
    ></v-text-field>
    <v-btn color="success" @click="login">Войти</v-btn>
    <template v-for="errorArray in errors" :key="errorArray">
      <v-alert
        prominent
        type="error"
        variant="outlined"
        v-for="error in errorArray"
        :key="error"
      >
        {{ error }}
      </v-alert></template
    >
  </v-form>
</template>

<script>
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      errors: {},
    };
  },

  methods: {
    login() {
      this.$store
        .dispatch("login", this.user)
        .then(() => this.$router.push("/"))
        .catch((error) => {
          if (error.response.data) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>