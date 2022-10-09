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
                    :list="circularOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="circular in circularOrder" :key="circular.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ circular.name }}</td>

                        <td>
                            <iframe
                                v-bind:src="'/pdf_files/' + circular.pdf"
                                height="60"
                                width="100vh"
                            ></iframe>
                        </td>
                        <td>{{ circular.list }}</td>
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
    props: ["circulardata"],
    data() {
        return {
            circularOrder: this.circulardata,
        };
    },
    methods: {
        update() {
            this.circularOrder.map((circular, index) => {
                circular.list = index + 1;
            });
            axios
                .post("circulars_sort", {
                    circulardata: this.circularOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.circulardata);
        //(this.name = this.circularData.name), (this.pdf = this.circularData.pdf);
    },
};
</script>