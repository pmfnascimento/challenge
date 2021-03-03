<template>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Driver</strong>
                </div>
                <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input id="name" name="name" placeholder="Insert the name of driver" type="text"
                                    class="form-control" aria-describedby="nameHelpBlock" v-model="form.name">
                                <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.name">
                                <strong>{{ this.errors.name[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <input id="email" name="email" type="email" class="form-control"
                                    placeholder="Insert the email of driver" v-model="form.email">
                                <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.email">
                                <strong>{{ this.errors.email[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Home</label>
                            <div class="col-5">
                                <input id="latitude" name="latitude" type="text" placeholder="Latitude"
                                    class="form-control" v-model="form.latitude">
                                <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.latitude">
                                <strong>{{ this.errors.latitude[0] }}</strong>
                                </span>
                            </div>
                            <div class="col-5">
                                <input id="longitude" name="longitude" type="text" placeholder="Longitude"
                                    class="form-control" v-model="form.longitude">
                                <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.longitude">
                                <strong>{{ this.errors.longitude[0] }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-10">
                                <input id="password" name="password" type="password" class="form-control"
                                    aria-describedby="passwordHelpBlock" v-model="form.password">
                                <span id="passwordHelpBlock" class="form-text text-muted">Insert the password or left black
                                    for no re-definition</span>
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="manager_id">
                            <div class="form-group row">
                                <div class="offset-2 col-5">
                                    <a href="" class="btn btn-danger btn-block">Cancelar</a>
                                </div>
                                <div class="col-5">
                                    <button name="submit" type="submit" @click.prevent="submitForm" class="btn btn-success btn-block">Save</button>
                                </div>
                            </div>

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Define Location Map
                        Driver (Drag the marker to choose coordinates)</strong>
                </div>
                <div class="card-body">
                    <l-map id="map" :zoom="zoom" :center="center">
                        <l-tile-layer :url="url"></l-tile-layer>
                        <l-marker :lat-lng="markers" :draggable="true" @dragend="onDragEnd"></l-marker>
                      </l-map>
                </div>
                </div>
            </div>
       
    <div class="col-6">
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
                                    <th class="text-center">Plate Number</th>
                                    <th class="text-center">Actual Location</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="car in cars" :key="car.car_id">
                                    <td class="text-center">{{ car.brand }}</td>
                                    <td class="text-center">{{ car.model }}</td>
                                    <td class="text-center">{{ car.plate_number }}</td>
                                    <td class="text-center">{{ car.latitude  + ' | ' +  car.longitude }}</td>
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
// Build icon assets.
import L from 'leaflet';

import { LMap, LTileLayer, LMarker } from "vue2-leaflet";

export default {
    props : ['id'],
    components: {
        LMap,
        LTileLayer,
        LMarker
    },
    data() {
    return {
        form: {
            name: '',
            email: '',
            password: '',
            latitude: '',
            longitude: '',
        },
      driver: [],
      cars: [],
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      zoom: 8,
      center: [41.5538, -7.8387],
      markers: [0,0],
      errors: [],
    };
  },
 mounted(){
    
       axios.get('/api/managers/getDriver/'+ this.id)
       .then((response) => {
          this.driver = response.data[0];
          this.form.name = this.driver.name;
          this.form.email = this.driver.email;
          this.form.latitude = this.driver.location.latitude;
          this.form.longitude = this.driver.location.longitude;
          this.markers = [this.driver.location.latitude, this.driver.location.longitude];
        }).catch(error => {

      });

      axios.get('/api/managers/getCars/'+ this.id)
       .then((response) => {
          this.cars = response.data;
        }).catch(error => {

      });
    },
    methods: {
        onDragEnd(event) {
         
            this.form.latitude = event.target._latlng.lat;
            this.form.longitude = event.target._latlng.lng;
       },
       submitForm(){
           axios.post('/api/managers/setDriver/'+ this.id, this.form)
       .then((response) => {
             window.location.href= '/managers/home';
        }).catch(error => {
            this.errors = error.response.data.errors

      });
       }
    }
}
</script>
<style>
 #map {
    height: 400px;
    width: 100%;
    z-index: 1001;
}
</style>
