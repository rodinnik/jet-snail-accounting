<template>
  <v-card>
    <v-tabs v-model="tab" bg-color="teal-darken-4">
      <v-tab value="one">Добавить водителя</v-tab>
      <v-tab value="two">Добавить транспорт</v-tab>
      <v-tab value="three">Редактировать водителя</v-tab>
      <v-tab value="four">Редактировать транспорт</v-tab>
    </v-tabs>

    <v-card-text>
      <v-window v-model="tab">
        <v-window-item value="one"> <driver-add-form /> </v-window-item>
        <v-window-item value="two"> <transport-add-form /> </v-window-item>
        <v-window-item value="three"> <driver-edit-form /> </v-window-item>
        <v-window-item value="four"> <transport-edit-form /> </v-window-item>
      </v-window>
    </v-card-text>
  </v-card>
</template>
<script>
import DriverAddForm from "../components/DriverAddForm.vue";
import TransportAddForm from "../components/TransportAddForm.vue";
import DriverEditForm from "../components/DriverEditForm.vue";
import TransportEditForm from "../components/TransportEditForm.vue";
export default {
  components: {
    DriverAddForm,
    TransportAddForm,
    DriverEditForm,
    TransportEditForm,
  },
  data: () => ({
    tab: null,
  }),
};
</script>