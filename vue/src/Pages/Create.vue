<script setup>
    import { HTTP } from '../axios';
    import { ref, onMounted } from 'vue';
    import PhotoInput from '../components/PhotoInput.vue';

    const data = ref({
        ads: []
    });

    onMounted(() => {
        getAllAds();
    })

    const form = ref({
        title: null,
        description: null,
        price: null
    })

    let photos = ref([]);

    let errors = ref([])
    let hasErrors = ref(false)

    const submit = () => {
        form.value.photos = photos.value.filter(photo => photo.link)
        
        HTTP.post('/api/store', form.value)
            .then((response) => {
                hasErrors.value = false;
                errors.value = [];
                form.value.title = null;
                form.value.price = null;
                form.value.description = null;
                form.value.photos = null;
                photos.value = [];
            })
            .catch((e) => {
                errors.value = e.response.data.errors;
                hasErrors.value = true;
            })
    }

    const getAllAds = () => {
        HTTP.get('/api/list')
            .then((response) => {
                data.value.ads = response.data.ads
            })
            .catch((e) => {
                console.log(e);
            })
    }

    const addPhoto = () => {
        if (photos.value.length <= 2) {
            photos.value.push({
                link: null
            })


        } else {
            hasErrors.value = true
            errors.value = {
                photos: [
                    'Максимум 3 фото'
                ]
            }
        }
    }

</script>

<template>
    <div class="container page">
        <div class="feedback">
            <form class="form" name="form" @submit.prevent="submit">
                <div v-if="hasErrors">
                    <div class="font-medium fw-bold text-red-600">Упс! Что-то пошло не так!</div>

                    <ul class="mt-3 list-disc list-inside text-sm text-danger">
                        <li v-for="(error, key) in errors" :key="key">{{ error[0] }}</li>
                    </ul>
                </div>
                <div class="mb-3">
                    <input v-model="form.title" type="title" class="form-control" id="title" aria-describedby="title" placeholder="Введите название">
                </div>
                
                <PhotoInput v-for="(photo, index) in photos" :key="index" v-model="photo.link" />

                <div class="mb-3">
                    <label for="description" class="form-label">Текст обращения</label>
                    <textarea v-model="form.description" class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <input v-model="form.price" type="price" class="form-control" id="price" aria-describedby="price" placeholder="Введите цену">
                </div>
                <button
                    type="submit" class="btn btn-primary"
                >
                    Отправить
                </button>
                <button
                    type="button" class="btn btn-secondary" style="margin-left: 10px"
                    @click="addPhoto"
                >
                    Добавить фото
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>
    .page {
        display: flex;
        height: 100vh;
        align-items: center;
    }
    .feedback {
        width: 600px;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 30px;
        margin: 0 auto;
        height: fit-content;
    }
    .form {
        
    }
</style>