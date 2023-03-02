<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Client</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
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
                                    <input type="text" class="form-control" v-model="client.description" id="">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:"update-client",
    data(){
        return{
            client:{
                name:"",
                surname:"",
                phone:"",
                description:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showClient()
    },
    methods:{
        async showClient(){
            await this.axios.get('/api/client/'+this.$route.params.id).then(response=>{
                const {name, surname, phone, description} = response.data
                this.client.name = name
                this.client.surname = surname
                this.client.phone = phone
                this.client.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post('/api/client/'+this.$route.params.id, this.client).then(response=>{
                this.$router.push({name:"clientList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
