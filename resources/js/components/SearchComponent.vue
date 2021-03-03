<template>
  <div>
    <header class="py-2 mb-3">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-lg-12">
            <h1 class="display-6 text-center mt-5 mb-2">
              Find a Car next toYou!
            </h1>
          </div>
        </div>
      </div>
    </header>
    <div class="container mb-5">
      <form>
        <div class="justify-content-center form-row">
          <div class="form-group col-md-3">
            <select class="form-control" v-model="form.brand">
              <option value="">Select...</option>
              <option v-for="car in carbrands" :key="car.id">{{ car.brand }}</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <select class="form-control" name="distance" v-model="form.distance" required>
              <option value="">Select...</option>
              <option value="1">1 Klm</option>
              <option value="5">1 Klm</option>
              <option value="10">10 Klm</option>
              <option value="20">20 Klm</option>
              <option value="30">30 Klm</option>
              <option value="40">40 Klm</option>
              <option value="50">50 Klm</option>
              <option value="60">60 Klm</option>
              <option value="70">70 Klm</option>
              <option value="80">80 Klm</option>
              <option value="90">90 Klm</option>
              <option value="100">100 Klm</option>
              
            </select>
          </div>
          <input name="latitude" type="hidden" v-model="form.latitude">
          <input name="longitude" type="hidden" v-model="form.longitude">
          <div class="form-group col-md-3">
            <button class="btn btn-primary btn-block" @click.prevent="submitForm">Search!</button>
          </div>
        </div>
      </form>
    </div>

    <div>
      <l-map id="map" class="mt-1" :zoom="zoom" :center="center" :markerZoomAnimation="true">
        <l-tile-layer :url="url"></l-tile-layer>
        <l-marker :lat-lng="locationLatLng" ></l-marker>
        <l-circle
          :lat-lng="position.center"
          :radius="position.radius"
          :color="position.color"
        />
        <l-circle
          :lat-lng="circle.center"
          :radius="circle.radius"
          :color="circle.color"
        />
        <l-marker :lat-lng="markerLatLng" ></l-marker>
      </l-map>
    </div>
  </div>
</template>
<script>
import { LMap, LTileLayer, LCircle, LMarker } from "vue2-leaflet";
import { featureGroup } from 'leaflet'
export default {
  components: {
    LMap,
    LTileLayer,
    LCircle,
    LMarker
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      zoom: 8,
      center: [0, 0],
      location:null,
      gettingLocation: false,
      errorStr:null,
      markerLatLng: [0,0],
      locationLatLng: [0,0],
      circle: {
        center: [0,0],
        radius: 2500,
        color: 'red'
      },
      position: {
        center: [0,0],
        radius: 2500,
        color: 'green'
      },
      form:{
        brand: '',
        latitude: '',
        longitude: '',
        distance: ''
      },
      carbrands: []
    };
  },
  created() {
    //do we support geolocation
    if(!("geolocation" in navigator)) {
      this.errorStr = 'Geolocation is not available.';
      return;
    }

    this.gettingLocation = true;
    // get position
    navigator.geolocation.getCurrentPosition(pos => {
      this.gettingLocation = false;
      this.location = pos;
      this.form.latitude = pos.coords.latitude;
      this.form.longitude = pos.coords.longitude;
      this.locationLatLng = [pos.coords.latitude,pos.coords.longitude];
      this.position.center = [pos.coords.latitude,pos.coords.longitude];
    }, err => {
      this.gettingLocation = false;
      this.errorStr = err.message;
    })

    axios
        .get("/api/getBrandCars")
        .then((response) => {
         this.carbrands = response.data;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });

  },
  methods:{
    submitForm() {
      axios
        .post("/api/getCars", this.form)
        .then((response) => {
          console.log(response);
          this.markerLatLng = [response.data[0].latitude,response.data[0].longitude];
          this.circle.center = [response.data[0].latitude,response.data[0].longitude];
          this.center = [response.data[0].latitude,response.data[0].longitude];
          this.zoom = 13;

        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  }
};
</script>
<style>
#map{
  height: 450px; 
  width: 100%;
}
</style>
