<script setup>
    const props = defineProps({
        ad: Object
    })
</script>

<template>
    <div class="card" style="width: 18rem;">
        <img v-if="props.ad.main_photo" class="card-img-top" :src="props.ad.main_photo.link">
        <div class="card-body">
            <p class="card-text">{{ props.ad.title }}</p>
        </div>
        <div class="card-body">
            <p class="card-text">{{ props.ad.price }}</p>
        </div>
    </div>
</template>