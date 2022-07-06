const { createApp } = Vue;

createApp({
  data() {
    return {
      export_action: "export_pdf",
      select_person: "new",
      person_id: 0,
    };
  },
  methods: {
    changeSelectPerson: function (mode) {
      this.select_person = mode;
    },
  },
}).mount("#vueApp");
