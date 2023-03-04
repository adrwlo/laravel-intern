<template>
    <div class="container">
        <div class="d-flex justify-content-end">
            <router-link :to='{name:"clientAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div v-if="clients.length > 0" class="container d-flex mt-5 flex-wrap gap-4 justify-content-center">
            <div v-for="(client, key) in clients" :key="key" class="card" style="width: 22rem;">
                <div class="card-body">
                    <h3 class="card-title">{{client.name + ' ' + client.surname}}</h3>
                    <h6 class="card-subtitle mb-2 text-muted">phone: {{client.phone}}</h6>
                    <p class="card-text">{{client.description}}</p>
                    <router-link :to='{name:"clientEdit", params:{id:client.id}}' class="btn btn-success">Edit</router-link>
                    <button type="button" @click="deleteClient(client.id)" class="btn btn-danger m-1">Delete</button>
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