<template>
  <v-form>
    <v-text-field v-model="driver.name" label="name" required></v-text-field>
    <v-btn color="success" @click="addDriver">Добавить</v-btn>
  </v-form>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      driver: { name: "" },
    };
  },

  methods: {
    addDriver() {
      axios
        .post("http://127.0.0.1:8000/api/drivers", this.driver)
        .catch((error) => {
          console.log(error);
        });
      this.driver.name = "";
    },
  },
};
</script>