<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

</script>

<template>
    <div class="mb-3">
        <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" type="photo" class="form-control" id="photo" aria-describedby="photo" placeholder="Введите ссылку на фотографию">
    </div>
</template>
