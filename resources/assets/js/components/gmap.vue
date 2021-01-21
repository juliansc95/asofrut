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
   data(){
            return{
                gps_id:0,
                productor_id:0,
                finca_id:0,
                nombre_productor:'',
                nombre_finca:'',
                latitud:0,
                longitud:0,              
                arrayGps:[],
            }
        },
  name: "SiteMap",
  props: [],
  methods: {   
    getOptions() {
      return {
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: false,
        streetViewControl: true,
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
            lat: 2.954829514,
            lng: -76.269498922
          };
    },
    getMarkers() {
       let me =this;
       var url ='gps';
        axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayGps= respuesta.gps;
                })
                .catch(function (error) {
                    console.log(error);
                });
      // generating markers for site map
        var markers = [];
        // remove this after lat long received from api.
        const tempLatLong = [
          { lat: 2.954829514, lng:-76.269498922},
          { lat: 2.964829514, lng:-76.279498922}
        ];
       for(let i=0;i<me.arrayGps['data'].length;i++){
          markers.push({
              position:  { lat: parseFloat(me.arrayGps['data'][i]['latitud']), lng:parseFloat(me.arrayGps['data'][i]['longitud'])},
              title:me.arrayGps['data'][i]['nombre_finca'],
              icon:'img/finca.png',        
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