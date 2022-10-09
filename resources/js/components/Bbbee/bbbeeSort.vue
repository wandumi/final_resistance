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
                    :list="bbbeeOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="bbbee in bbbeeOrder" :key="bbbee.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ bbbee.name }}</td>

                        <td>
                            <iframe
                                v-bind:src="'/pdf_files/' + bbbee.pdf"
                                height="60"
                                width="100vh"
                            ></iframe>
                        </td>
                        <td>{{ bbbee.list }}</td>
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
    props: ["bbbeedata"],
    data() {
        return {
            bbbeeOrder: this.bbbeedata,
        };
    },
    methods: {
        update() {
            this.bbbeeOrder.map((bbbee, index) => {
                bbbee.list = index + 1;
            });

            axios
                .post("bbbees_sort", {
                    bbbeedata: this.bbbeeOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.bbbeedata);
        //(this.name = this.bbbeeData.name), (this.pdf = this.bbbeeData.pdf);
    },
};
</script>
