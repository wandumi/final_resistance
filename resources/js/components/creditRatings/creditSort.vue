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
                    :list="creditOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="credit in creditOrder" :key="credit.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ credit.name }}</td>

                        <td>
                            <iframe
                                v-bind:src="'/pdf_files/' + credit.pdf"
                                height="60"
                                width="100vh"
                            ></iframe>
                        </td>
                        <td>{{ credit.list }}</td>
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
    props: ["creditdata"],
    data() {
        return {
            creditOrder: this.creditdata,
        };
    },
    methods: {
        update() {
            this.creditOrder.map((credit, index) => {
                credit.list = index + 1;
            });
            axios
                .post("credit_ratings_sort", {
                    creditdata: this.creditOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.creditdata);
        //(this.name = this.creditData.name), (this.pdf = this.creditData.pdf);
    },
};
</script>