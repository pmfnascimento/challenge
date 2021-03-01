<template>

    <div class="row justify-content-center">
        <div class="col-9">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="far fa-arrow-alt-circle-up"></i> <strong>Cars</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Band</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Actual Location</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="car in cars" :key="car.car_id">
                                <td class="text-center">{{ car.brand }}</td>
                                <td class="text-center">{{ car.model }}</td>
                                 <td class="text-center">{{ car.latitude + ' | ' + car.longitude }}</td> 
                                <td class="text-center">
                                    <a :href="`/drivers/cars/${car.car_id}/edit/`" class="btn btn-secondary btn-sm">Edit+ </a>
                                   <button class="btn btn-danger btn-sm">Delete +</button>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
      props : ['user'],
    data(){
        return{
            cars: []
        }
    },

       
        mounted(){
            
               axios.get('/api/drivers/getCars/'+ this.user)
               .then((response) => {
                  this.cars = response.data;
                  console.log(this.cars);
                }).catch(error => {

              });
            },
     
    }
</script>
