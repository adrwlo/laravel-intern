<template>
    <div class="row">
        <div class="container mt-5" style="width: 30rem">
            <div class="card">
                <div class="card-header">
                    <h4>Add Client</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="client.name" id="">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" class="form-control" v-model="client.surname" id="">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" v-model="client.phone" id="">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="client.description" id=""/>
                                </div>
                            </div>
                            <div class="col-12 mb-2 mt-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default{
    name:"add-client",
    data(){
        return{
            client:{
                name:"",
                surname:"",
                phone:"",
                description:""
            }
        }
    },
    methods:{
        async create(){
            await axios.post('/api/client', this.client).then(response=>{
                this.$router.push({name:"clientList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>


