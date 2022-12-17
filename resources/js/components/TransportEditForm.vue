<template>
  <v-form>
    <v-select
      v-model="selectedTransport"
      :items="transportItems"
      label="Выберите транспорт"
      return-object
    ></v-select>
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
    <v-btn color="success" @click="editTransport">Изменить</v-btn>
    <v-btn color="error" @click="deleteTransport">Удалить</v-btn>
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
      transports: [],
      drivers: [],
      selectedTransport: {},
    };
  },
  watch: {
    selectedTransport: {
      handler(val) {
        this.transport = {
          ...this.transports.find((transport) => transport.id === val.value),
        };
      },
      deep: true,
    },
  },
  created() {
    this.getTransports();
    this.getDrivers();
  },
  computed: {
    driverItems() {
      return this.drivers.map((driver) => {
        return { title: driver.name, value: driver.id };
      });
    },
    transportItems() {
      return this.transports.map((transport) => {
        return {
          title: `${transport.firm} ${transport.model}`,
          value: transport.id,
        };
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
    getTransports() {
      axios
        .get("http://127.0.0.1:8000/api/transports")
        .then(({ data }) => {
          this.transports = data;
          const transport = data[0];
          this.selectedTransport = {
            title: `${transport.firm} ${transport.model}`,
            value: transport.id,
          };
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteTransport() {
      axios
        .delete(
          `http://127.0.0.1:8000/api/transports/${this.selectedTransport.value}`
        )
        .catch((error) => {
          console.log(error);
        });
      this.getTransports();
      this.transport = {
        type: "",
        status: "",
        model: "",
        firm: "",
        driver_id: null,
      };
    },
    editTransport() {
      axios
        .put(
          `http://127.0.0.1:8000/api/transports/${this.selectedTransport.value}`,
          this.transport
        )
        .catch((error) => {
          console.log(error);
        });
      this.getTransports();
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