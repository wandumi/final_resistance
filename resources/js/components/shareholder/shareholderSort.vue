<template>
    <div class="col-lg-12 my-5">
        <div class="row">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Order</th>
                    </tr>
                </thead>

                <draggable
                    :list="shareholderOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="shareholder in shareholderOrder" :key="shareholder.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ shareholder.name }}</td>

                       
                        <td>{{ shareholder.list }}</td>
                    </tr>
                </draggable>

                <tfoot class="thead-light"></tfoot>
            </table>
        </div>
    </div>
</template>

<style></style>

<script>
import axios from "axios";
import draggable from "vuedraggable";
export default {
    name: 'shareholderSort',
    components: {
        draggable,
        
    },
    props: ["shareholderdata"],
    data() {
        return {
            shareholderOrder: this.shareholderdata,
        };
    },
    methods: {
        update() {
            this.shareholderOrder.map((shareholder, index) => {
                shareholder.list = index + 1;
            });

            axios
                .post("shareholders_sort", {
                    shareholderdata: this.shareholderOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.shareholderdata);
        //(this.name = this.shareholderData.name), (this.pdf = this.shareholderData.pdf);
    },
};
</script>
