<template>
    <Show>
        <template #header>
            <div @click="back">
                <svg  width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>
            </div>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] montserrat tracking-wide tracking-[.05em]">Enter QR ID</h1>
            </div>
            <div @click="back">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                </svg>
            </div>
        </template>
        <div class="px-[14px] w-full">
            <select-component v-model="search_text" :list="collection" :key="search_text" @selected="select"/>
        </div>
    </Show>
</template>

<script>
import Show from "@/Layouts/Show.vue";
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Link } from '@inertiajs/inertia-vue3'
import SelectComponent from '@/Components/SelectComponent.vue'

export default {
    components:{
        Link,
        BreezeGuestLayout,
        Show,
        SelectComponent
    },
    name: "FindByQr",
    data() {
        return {
            search_text:null,
            collection:[],
        }
    },
    mounted() {
    },
    watch: {
        // whenever question changes, this function will run
        search_text(newQuestion, oldQuestion) {
            this.find_collection();
        }
    },
    methods: {
        back(){
            this.$inertia.visit(this.route('scan'));
        },
        find_collection(){
            axios.get('/api/get_qr?qr_id='+this.search_text)
                .then(response => {
                    this.collection = response.data
                })
        },
        select(value){
            this.$inertia.get(route('inspection.index') + '/'+value)
        }
    }
}
</script>

<style scoped>

</style>
