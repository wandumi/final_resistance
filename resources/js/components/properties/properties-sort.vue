<template>
    <div class="col-lg-12 my-5">
        <div class="row">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Action</th>
                        <th>Name</th>
                        <th>Banner Image</th>
                        <th>Cover Image</th>
                        <th>Order</th>
                    </tr>
                </thead>

                <draggable
                    :list="propertiesOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="properties in propertiesOrder" :key="properties.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ properties.name }}</td>
                        <td>
                            <img
                                v-bind:src="'/banner_images/' + properties.banner_image"
                                height="60"
                                width="100vh"
                            />
                        </td>
                        <td>
                            <img
                                v-bind:src="'/cover_images/' + properties.cover_image"
                                height="60"
                                width="100vh"
                            />
                        </td>
                        <td>{{ properties.list }}</td>
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
    props: ["propertiesdata"],
    data() {
        return {
            propertiesOrder: this.propertiesdata,
        };
    },
    methods: {
        update() {
            this.propertiesOrder.map((properties, index) => {
                properties.list = index + 1;
            });

            axios
                .post("properties_sort", {
                    propertiesdata: this.propertiesOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.propertiesdata);
        //(this.name = this.propertiesData.name), (this.pdf = this.propertiesData.pdf);
    },
};
</script>
