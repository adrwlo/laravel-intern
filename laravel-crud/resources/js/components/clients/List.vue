<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"clientAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="clients.length > 0">
                                <tr v-for="(client, key) in clients" :key="key">
                                    <td>{{client.id}}</td>
                                    <td>{{client.name}}</td>
                                    <td>{{client.surname}}</td>
                                    <td>{{client.phone}}</td>
                                    <td>{{client.description}}</td>
                                    <td>
                                        <router-link :to='{name:"clientEdit", params:{id:client.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteClient(client.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No clients found.</td>
                                </tr>
                            </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name:"clients",
    data(){
        return{
            clients:[]
        }
    },
    mounted(){
        this.getClients();
    },
    methods:{
        async getClients(){
            await axios.get('http://localhost:8000/api/client').then(response=>{
                this.clients = response.data
            }).catch(error=>{
                console.log(error)
                this.clients = []
            })
        },
        deleteClient(id){
            if(confirm("Are you sure to delete this client?")){
                axios.delete('http://localhost:8000/api/client/'+id).then(response=>{
                    this.getClients()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>