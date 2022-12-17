<template>
  <v-form>
    <v-text-field v-model="user.name" label="name" required></v-text-field>
    <v-text-field v-model="user.email" label="email" required></v-text-field>
    <v-text-field
      v-model="user.password"
      label="password"
      required
    ></v-text-field>
    <v-text-field
      v-model="user.password_confirmation"
      label="password_confirmation"
      required
    ></v-text-field>
    <v-btn color="success" @click="register">Зарегистрироваться</v-btn>
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
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
    };
  },

  methods: {
    register() {
      this.$store
        .dispatch("register", this.user)
        .then(() => this.$router.push("/login"))
        .catch((error) => {
          if (error.response.data) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>