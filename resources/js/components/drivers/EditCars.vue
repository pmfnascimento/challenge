<template>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Create Car</strong>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="brand" class="col-3 col-form-label">Brand</label>
                    <div class="col-8">
                        <input id="brand" name="brand" placeholder="Insert the brand of car" type="text" class="form-control" v-model="form.brand">
                        <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.brand">
                            <strong>{{ this.errors.brand[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="model" class="col-3 col-form-label">Model</label>
                    <div class="col-8">
                        <input id="model" name="model" type="text" class="form-control" placeholder="Insert the model of car" v-model="form.model">
                        <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.model">
                            <strong>{{ this.errors.model[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="plate_number" class="col-3 col-form-label">Plate Number</label>
                    <div class="col-8">
                        <input id="plate_number" name="plate_number" type="text" class="form-control" placeholder="Insert the plate number of car" v-model="form.plate_number">
                        <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.plate_number">
                            <strong>{{ this.errors.plate_number[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-3 col-form-label">Actual Location</label>
                    <div class="col-4">
                        <input id="latitude" name="latitude" type="text" placeholder="Latitude" class="form-control" ref="latitude" v-model="form.latitude">
                        <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.latitude">
                            <strong>{{ this.errors.latitude[0] }}</strong>
                        </span>
                    </div>
                    <div class="col-4">
                        <input id="longitude" name="longitude" type="text" placeholder="Longitude" class="form-control" ref="longitude" v-model="form.longitude">
                        <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.longitude">
                            <strong>{{ this.errors.longitude[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-3 col-4">
                        <a href="/drivers/home" class="btn btn-danger btn-block">Cancelar</a>
                    </div>
                    <div class="col-4">
                        <button name="submit" type="submit" @click.prevent="submitForm" class="btn btn-success btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Define Actual Location Map of Car</strong>
            </div>
            <div class="card-body">
                <l-map id="map" :zoom="zoom" :center="center">
                    <l-tile-layer :url="url"></l-tile-layer>
                    <l-marker :lat-lng="markers" :draggable="true" @dragend="onDragEnd"></l-marker>
                </l-map>
            </div>
        </div>
    </div>
</div>
</template>

<script>
// Build icon assets.
import L from 'leaflet';

import {
    LMap,
    LTileLayer,
    LMarker
} from "vue2-leaflet";

export default {
    props: ['id'],
    components: {
        LMap,
        LTileLayer,
        LMarker
    },
    data() {
        return {
            form: {
                brand: '',
                model: '',
                plate_number: '',
                latitude: '',
                longitude: '',
            },
            car: [],
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            zoom: 8,
            center: [41.5538, -7.8387],
            markers: [0, 0],
            errors: [],
        };
    },

    mounted() {

        axios.get('/api/drivers/getCar/' + this.id)
            .then((response) => {
                this.car = response.data[0];
                this.form.brand = this.car.brand;
                this.form.model = this.car.model;
                this.form.plate_number = this.car.plate_number;
                this.form.latitude = this.car.location.latitude;
                this.form.longitude = this.car.location.longitude;
                this.markers = [this.car.location.latitude, this.car.location.longitude];
            }).catch(error => {

            });
    },
    methods: {
        onDragEnd(event) {

            this.form.latitude = event.target._latlng.lat;
            this.form.longitude = event.target._latlng.lng;
        },
        submitForm() {
            axios.post('/api/drivers/setCar/' + this.id, this.form)
                .then((response) => {
                    window.location.href = '/drivers/home';
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
