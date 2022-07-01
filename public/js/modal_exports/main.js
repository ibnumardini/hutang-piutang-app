const { createApp } = Vue;

createApp({
  data() {
    return {
      export_action: "export_pdf",
    };
  },
}).mount("#modal-content__exports");
