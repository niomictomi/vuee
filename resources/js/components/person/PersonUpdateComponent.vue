<template>
  <div>
    <personnavcomponent></personnavcomponent>
    <br>
    <h4>Update person</h4>
    <div class="row">
      <div class="col-md-4">
        <form @submit.prevent="updatePerson">
          <div class="form-group">
            <label>First Name</label>
            <input type="textfield" class="form-control" placeholder="First Name" ref="txFirstName">
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="textfield" class="form-control" placeholder="Last Name" ref="txLastName">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="E-Mail" ref="txEmail">
          </div>
          <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import PersonNavComponent from "./PersonNavComponent";
export default {
  components: {
    personnavcomponent: PersonNavComponent
  },
  created(){
    this.getPersonDetail();
  },
  methods: {
    updatePerson() {
        $("#btnSubmit").attr("class","btn btn-primary disabled").text("Processing...");
        axios.put('http://localhost:8000/api/person/'+this.$route.params.id,{
            first_name: this.$refs.txFirstName.value,
            last_name: this.$refs.txLastName.value,
            email: this.$refs.txEmail.value
        }).then(response => {
            this.$router.push({name: 'Person List'});
        });
    },
    getPersonDetail(){
      axios.get('http://localhost:8000/api/person/'+this.$route.params.id).then(response => {
        this.$refs.txFirstName.value = response.data.first_name;
        this.$refs.txLastName.value = response.data.last_name;
        this.$refs.txEmail.value = response.data.email;
      });
    }
  }
};
</script>
