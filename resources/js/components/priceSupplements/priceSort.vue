<template>
    <div class="col-lg-12 my-5">
        <div class="row">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>PDFs</th>
                        <th>Order</th>
                    </tr>
                </thead>

                <draggable
                    :list="priceOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="price in priceOrder" :key="price.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ price.name }}</td>

                        <td>
                            <iframe
                                v-bind:src="'/pdf_files/' + price.pdf"
                                height="60"
                                width="100vh"
                            ></iframe>
                        </td>
                        <td>{{ price.list }}</td>
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
    components: {
        draggable,
    },
    props: ["pricedata"],
    data() {
        return {
            priceOrder: this.pricedata,
        };
    },
    methods: {
        update() {
            this.priceOrder.map((price, index) => {
                price.list = index + 1;
            });
            axios
                .post("price_supplements_sort", {
                    pricedata: this.priceOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.pricedata);
        //(this.name = this.priceData.name), (this.pdf = this.priceData.pdf);
    },
};
</script>