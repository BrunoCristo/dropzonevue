<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>
          <div class="card-body">
            <form action="/formSubmit" method="post" @submit="submitForm">
             <p v-if="errors.length">
                <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>
              I'm an example component.
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="title"
                  id="title"
                  placeholder="Titulo"
                  value
                  autofocus
                  v-model="title"
                >
              </div>

              <vue-dropzone
                ref="myVueDropzone"
                v-on:vdropzone-sending="sendingEvent"
                id="dropzone"
                :options="dropzoneOptions"
              ></vue-dropzone>
              <input type="submit" value="enviar">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  data: function() {
    return {
      errors: [],
      title: "",
      dropzoneOptions: {
        url: "/formSubmit",
        autoProcessQueue: false,
        headers: {
          "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]")
            .content
        }
      }
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    checkForm: function (e) {
      if (this.name && this.age) {
        return true;
      }

      this.errors = [];

      if (!this.name) {
        this.errors.push('O nome é obrigatório.');
      }
      if (!this.age) {
        this.errors.push('A idade é obrigatória.');
      }
    },

    sendingEvent: function(file, xhr, formData) {
      console.log(formData);
      formData.append("title", title.value);
      // window.toastr.warning('', 'Event : vdropzone-sending-multiple')
    },
    submitForm: function(e) {
      e.preventDefault();
      // alert("hey");
      this.$refs.myVueDropzone.processQueue();
      //   return false;
    }
  }
};
</script>
