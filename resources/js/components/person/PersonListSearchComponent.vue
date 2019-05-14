<template>
  <div>
    <personnavcomponent></personnavcomponent>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Delete This Data ?</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="submit"
              class="btn btn-danger"
              data-dismiss="modal"
              v-on:click="deletePerson()"
              id="btnDelete"
            >Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <br>
        <div class="alert alert-success" role="alert">Showing result for '{{qParams}}'</div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id">
              <td>{{post.first_name}}</td>
              <td>{{post.last_name}}</td>
              <td>{{post.email}}</td>
              <td>
                <router-link :to="'/update/'+post.id" class="btn btn-warning">Update</router-link>
                <button
                  class="btn btn-danger"
                  data-toggle="modal"
                  data-target="#modalDelete"
                  v-on:click="prepareDeleteId = post.id"
                >Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import PersonNavComponent from "./PersonNavComponent.vue";
export default {
  components: {
    personnavcomponent: PersonNavComponent,
    qParams: ''
  },
  data() {
    return {
      posts: [],
      prepareDeleteId: ""
    };
  },
  created() {
    this.loadPersonList();
    this.qParams = this.$route.query.q;
  },
  methods: {
    loadPersonList() {
      $("#loading").attr("hidden","");
      axios
        .get(
          "http://localhost:8000/api/person/search/query?q=" +
            this.$route.query.q
        )
        .then(response => {
          this.posts = response.data;
        });
    },
    deletePerson() {
      $("#btnDelete").attr("class","btn btn-primary disabled").text("Processing...");
      axios
        .delete("http://localhost:8000/api/person/" + this.prepareDeleteId)
        .then(response => {
          this.loadPersonList();
        });
    }
  }
};
</script>