<template>
  <v-form>
    <v-select
      v-model="transport.driver_id"
      :items="driverItems"
      label="закрепленный водитель"
    ></v-select>
    <v-select
      v-model="transport.type"
      :items="typeItems"
      label="тип"
    ></v-select>
    <v-select
      v-model="transport.status"
      :items="statusItems"
      label="статус"
    ></v-select>
    <v-text-field
      v-model="transport.firm"
      label="фирма"
      required
    ></v-text-field>
    <v-text-field
      v-model="transport.model"
      label="модель"
      required
    ></v-text-field>
    <v-btn color="success" @click="addTransport">Добавить</v-btn>
  </v-form>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      transport: { type: "", status: "", model: "", firm: "", driver_id: null },
      statusItems: ["активная", "на ремонте", "продана", "не используется"],
      typeItems: ["легковые авто", "грузовики", "фургоны", "спецтехника"],
      drivers: [],
    };
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
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addTransport() {
      axios
        .post("http://127.0.0.1:8000/api/transports", this.transport)
        .catch((error) => {
          console.log(error);
        });
      this.transport = {
        type: "",
        status: "",
        model: "",
        firm: "",
        driver_id: null,
      };
    },
  },
};
</script>