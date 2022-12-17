<template>
  <v-form>
    <v-select
      v-model="selectedDriver"
      :items="driverItems"
      label="Выберите водителя"
      return-object
    ></v-select>
    <v-text-field v-model="driver.name" label="name" required></v-text-field>
    <v-btn color="success" @click="editDriver">Изменить</v-btn>
    <v-btn color="error" @click="deleteDriver">Удалить</v-btn>
  </v-form>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      driver: { name: "" },
      selectedDriver: {},
      drivers: [],
    };
  },
  watch: {
    selectedDriver: {
      handler(val) {
        this.driver.name = val.title;
      },
      deep: true,
    },
  },
  created() {
    this.getDrivers();
  },
  computed: {
    driverItems() {
      return this.drivers.map((driver) => {
        return { title: driver.name, value: driver.id };
      });
    },
  },
  methods: {
    getDrivers() {
      axios
        .get("http://127.0.0.1:8000/api/drivers")
        .then(({ data }) => {
          this.drivers = data;
          const driver = data[0];
          this.selectedDriver = { title: driver.name, value: driver.id };
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteDriver() {
      axios
        .delete(
          `http://127.0.0.1:8000/api/drivers/${this.selectedDriver.value}`
        )
        .catch((error) => {
          console.log(error);
        });
      this.getDrivers();
      this.driver.name = "";
    },
    editDriver() {
      axios
        .put(
          `http://127.0.0.1:8000/api/drivers/${this.selectedDriver.value}`,
          this.driver
        )
        .catch((error) => {
          console.log(error);
        });
      this.getDrivers();
      this.driver.name = "";
    },
  },
};
</script>