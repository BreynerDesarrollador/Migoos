<template>
    <gmap-autocomplete
            @place_changed="setPlace">
    </gmap-autocomplete>
</template>

<script>

    export default {
        props: ['id'],
        data() {
            return {
                data: '',
                currentPlace: ''
            }
        },
        methods: {
            setPlace(place) {
                ciudadgeneral = place.formatted_address;
            },
        }
    }
</script>

