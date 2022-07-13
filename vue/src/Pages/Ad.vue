<script setup>
    import { ref, onMounted } from 'vue';
    import { HTTP } from '../axios';

    const props = defineProps({
        id: String
    })

    const ad = ref(null);

    onMounted(() => {
        getAdById();
    })

    const getAdById = () => {
        HTTP.get(`/api/ads/${props.id}`)
            .then((response) => {
                ad.value = response.data.ad
            })
            .catch((e) => {
                console.log(e);
            })
    }
    
</script>

<template>
    <div class="container mt-5">
        <div v-if="ad" class="card" style="width: 18rem;">
            <img v-if="ad.mainPhoto" class="card-img-top" :src="ad.mainPhoto.link">
            <div class="card-body">
                <p class="card-text">{{ ad.title }}</p>
            </div>
            <div class="card-body">
                <p class="card-text">{{ ad.price }}</p>
            </div>
        </div>
    </div>
</template>