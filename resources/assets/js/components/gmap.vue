<template>
<GmapMap
      :center="{lat:2.954829514, lng:-76.269498922}"
      :zoom="15"
      map-type-id="roadmap"
      style="width: 100%; height: 500px" 
      id="googleMap"
    >
        <GmapMarker
            :key="index"
            v-for="(m, index) in  getMarkers()"
           :position="m.position"
            :clickable="true"
            :draggable="false"
            :title="m.title"
            :icon="m.icon"
            @click="clicked()"
        >
        </GmapMarker>
    </GmapMap>
</template>
<script>
export default {
  name: "SiteMap",
  props: [],
  methods: {   
    getOptions() {
      return {
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        disableDefaultUi: false
      };
    },
    clicked() {
     // after click
    },
    getCenter() {     
          return {
            lat: 37.12523,
            lng: -122.1252
          };
    },
    getMarkers() {
      // generating markers for site map
        var markers = [];
        // remove this after lat long received from api.
        const tempLatLong = [
          { lat: 37.9068361, lng: -122.116971 },
          { lat: 37.9168362, lng: -122.076972 },
          { lat: 37.9268363, lng: -122.136973 },
          { lat: 37.9368364, lng: -122.146974 },
          { lat: 37.9468365, lng: -122.106975 },
          { lat: 37.9568366, lng: -122.166976 },
          { lat: 37.9668367, lng: -122.176977 },
          { lat: 37.9768368, lng: -122.016978 },
          { lat: 37.9868369, lng: -122.196979 }
        ];
       for(let i=0;i<tempLatLong.length;i++){
          markers.push({
              position: tempLatLong[i],
              title: 'test title',        
            });
        }
        return markers;      
    },
  },
  components: {},
  created() {},
  mounted() {
  }
};
</script>