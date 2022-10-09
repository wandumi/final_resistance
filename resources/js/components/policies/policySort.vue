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
                    :list="policyOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="policy in policyOrder" :key="policy.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ policy.name }}</td>

                        <td>
                            <iframe
                                v-bind:src="'/pdf_files/' + policy.pdf"
                                height="60"
                                width="100vh"
                            ></iframe>
                        </td>
                        <td>{{ policy.list }}</td>
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
    props: ["policydata"],
    data() {
        return {
            policyOrder: this.policydata,
        };
    },
    methods: {
        update() {
            this.policyOrder.map((policy, index) => {
                policy.list = index + 1;
            });
            axios
                .post("policies_sort", {
                    policydata: this.policyOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.policydata);
        //(this.name = this.policyData.name), (this.pdf = this.policyData.pdf);
    },
};
</script>