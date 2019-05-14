<template>
  <div>
    <personnavcomponent></personnavcomponent>
    <div
      class="modal fade"
      id="modalDelete"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
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
            <button type="submit" class="btn btn-danger" data-dismiss="modal" v-on:click="deletePerson()" id="btnDelete">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
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
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" v-on:click="prepareDeleteId = post.id">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
        <nav aria-label="...">
          <ul class="pagination">
            <li class="page-item disabled" id="pagePrevious">
              <a class="page-link" href="#" v-on:click="page-=1; loadPersonList()">Previous</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link">Page {{page}} of {{lastPage}}</a>
            </li>
            <li class="page-item" id="pageNext">
              <a class="page-link" href="#" v-on:click="page+=1; loadPersonList()">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import PersonNavComponent from "./PersonNavComponent.vue";
export default {
  components: {
    personnavcomponent: PersonNavComponent
  },
  data() {
    return {
      posts: [],
      prepareDeleteId: '',
      page: 1,
      lastPage: 1
    };
  },
  created() {
    this.loadPersonList();
  },
  methods: {
    loadPersonList() {
      axios.get("http://localhost:8000/api/person?page="+this.page).then(response => {
        this.posts = response.data.data;
        this.setPaging(response.data.current_page,response.data.last_page);
        this.lastPage = response.data.last_page;
      });
    },
    deletePerson(){
      $("#btnDelete").attr("class","btn btn-primary disabled").text("Processing...");
      axios.delete("http://localhost:8000/api/person/"+this.prepareDeleteId).then(response=>{
        this.loadPersonList();
      });
    },
    setPaging(current,last){ 
      if(current == 1){
        $("#pagePrevious").attr("class","page-item disabled");
      }else{
        $("#pagePrevious").attr("class","page-item");
      } 
      if(current == last){
        $("#pageNext").attr("class","page-item disabled");
      }else{
        $("#pageNext").attr("class","page-item");
      } 
    }
  }
};
</script>