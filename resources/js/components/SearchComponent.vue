<template>
  <div>
    <header class="py-2 mb-2">
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
            <input type="text" class="form-control" placeholder="First name" />
          </div>
          <div class="form-group col-md-3">
            <input type="text" class="form-control" placeholder="Last name" />
          </div>
          <div class="form-group col-md-3">
            <button class="btn btn-primary btn-block">Search!</button>
          </div>
        </div>
      </form>
    </div>

    <div>
      <l-map style="height: 350px; width: 1005" :zoom="zoom" :center="center">
        <l-tile-layer :url="url"></l-tile-layer>
        <l-circle
          :lat-lng="circle.center"
          :radius="circle.radius"
          :color="circle.color"
        />
      </l-map>
    </div>
  </div>
</template>
<script>
import { LMap, LTileLayer, LCircle } from "vue2-leaflet";

export default {
  components: {
    LMap,
    LTileLayer,
    LCircle,
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      zoom: 8,
      center: [47.31322, -1.319482],
      circle: {
        center: [47.41322, -1.0482],
        radius: 4500,
        color: "red",
      },
    };
  },
};
</script>
