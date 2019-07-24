<template>
    <div style="height: 500px; width: 100%;">
        <h2 class="text-center mt-5 mb-5">Explore points on the map</h2>
        <l-map style="height: 500px; width: 100%;" :zoom="zoom" :center="center" @click="handleMapClick">
            <l-tile-layer :url="url"></l-tile-layer>
            <l-marker v-for="point in points" :key="point.id" :lat-lng="JSON.parse(point.lat_lng)" >
                <l-popup>
                    <p class="mb-0 mt-0">
                        <strong>Category: </strong>
                        {{ point.category.name }}
                    </p>
                    <p class="mb-0 mt-0" v-if="point.comment">
                        <strong>Comment: </strong>
                        {{ point.comment }}
                    </p>
                    <p class="mb-0 mt-0">
                        <strong>Date: </strong>
                        {{ point.created_at }}
                    </p>
                </l-popup>
            </l-marker>
            <l-layer-group ref="ask4add">
                <l-popup latlng="[59.889184, 72.026367]">
                    <button class="btn btn-secondary btn-sm" type="button" @click="add" >
                        Add point here
                    </button>
                </l-popup>
            </l-layer-group>
        </l-map>
    </div>
</template>

<script>
    import Vue from 'vue'
    import {LMap, LTileLayer, LMarker, LPopup, LLayerGroup} from 'vue2-leaflet'
    import { Icon } from 'leaflet'
    import 'leaflet/dist/leaflet.css'

    Vue.component('l-map', LMap)
    Vue.component('l-tile-layer', LTileLayer)
    Vue.component('l-marker', LMarker)
    Vue.component('l-popup', LPopup)
    Vue.component('l-layer-group', LLayerGroup)

    delete Icon.Default.prototype._getIconUrl;

    Icon.Default.mergeOptions({
        iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
        iconUrl: require('leaflet/dist/images/marker-icon.png'),
        shadowUrl: require('leaflet/dist/images/marker-shadow.png')
    });

    export default {
        data() {
            return {
                url: "http://{s}.tile.osm.org/{z}/{x}/{y}.png",
                zoom: 4,
                center: [59.889184, 72.026367],
                markerLatLng: [59.889184, 72.026367],
                point: {}
            };
        },
        computed: {
            points() {
                return this.$store.state.points
            }
        },
        methods: {
            handleMapClick(e) {
                let {lat, lng} = e.latlng
                this.$refs.ask4add.mapObject.openPopup([lat, lng])
                this.point = {lat, lng}
            },
            add() {
                this.$router.push({name: 'add', params: {lat: this.point.lat, lng: this.point.lng}})
            }
        }
    };
</script>

