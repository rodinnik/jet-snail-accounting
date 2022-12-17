<template>
  <v-row dense>
    <v-col v-for="transport in transports" :key="transport.id" cols="12">
      <v-card
        :title="`${transport.type}: ${transport.firm} ${transport.model}`"
        :subtitle="transport.status"
        :text="`Ответственный водитель: ${transport.driver.name}`"
      ></v-card>
    </v-col>
  </v-row>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      transports: null,
    };
  },
  created() {
    this.getTransports();
  },
  methods: {
    getTransports() {
      axios
        .get("http://127.0.0.1:8000/api/transports")
        .then(({ data }) => {
          this.transports = data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>