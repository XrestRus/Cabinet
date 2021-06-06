<template>
<div class="section">
    <div class="section-title">Фотография</div>
    <div class="section-body">
        <div 
            class="section-img image" 
            :style="{ backgroundImage: img }"
        >
        </div>
        <div 
            class="section-button"
            v-if='isLoad'
        >
            <label 
                for='loadFile' 
                class="label-btn"
            >
                <input 
                    id="loadFile" 
                    type="file" 
                    class="hidden" 
                    accept=".png,.jpg,.svg" 
                    @input="load($event)"
                >
                <span>
                    Загрузить
                </span>
            </label>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        modelValue: null,
        isLoad: false
    },

    data() {
        return {
            img: this.modelValue ? `url(/storage/${ this.modelValue })` : null,
        }
    },

    methods: {
        load(e) {
            let fr = new FileReader();

            fr.readAsDataURL(e.target.files[0]);
            fr.onload = (e) => {
                this.img = 'url(' + fr.result + ')';
            }
          
            this.$emit("update:modelValue", e.target.files[0]);
        }
    },
}
</script>

<style>

</style>