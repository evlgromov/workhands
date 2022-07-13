<script setup>
    import Card from '../components/Card.vue';
    import { HTTP } from '../axios';
    import { ref, onMounted } from 'vue';

    const data = ref({
        ads: []
    });

    const pagesCount = ref(0);

    onMounted(() => {
        getAllAds();
    })

    const submit = () => {
        HTTP.post('/api/store', form.value)
            .then((response) => {
                hasErrors.value = false;
                errors.value = [];
                form.value.name = null;
                form.value.phone = null;
                form.value.appealText = null;
                getAllAds();
            })
            .catch((e) => {
                errors.value = e.response.data.errors;
                hasErrors.value = true;
            })
    }

    const getAllAds = (page = 1) => {
        HTTP.get('/api/list?page=' + page)
            .then((response) => {
                data.value.ads = response.data.ads.data
                pagesCount.value = Math.ceil(response.data.ads.total/response.data.ads.per_page);
            })
            .catch((e) => {
                console.log(e);
            })
    }

</script>

<template>
    <div class="container page">
        <div class="list">
            <Card
                v-for="ad in data.ads" :key="ad.id" :ad="ad" 
                @click="$router.push({ path: `/show/${ad.id}`})"
            />
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-for="n in pagesCount" :key="n" class="page-item"><a class="page-link" @click="getAllAds(n)">{{n}}</a></li>
            </ul>
        </nav>
    </div>
</template>

<style scoped>
    .list {
        margin: 100px 0;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
</style>