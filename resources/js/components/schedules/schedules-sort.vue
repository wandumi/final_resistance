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
                    :list="scheduleOrder"
                    :options="{ animation: 200, handle: '.my-handle' }"
                    :element="'tbody'"
                    @change="update"
                >
                    <tr v-for="schedule in scheduleOrder" :key="schedule.id">
                        <td>
                            <i
                                class="fas fa-arrows-alt my-handle"
                                style="cursor: move"
                            ></i>
                        </td>
                        <td>{{ schedule.name }}</td>

                       
                        <td>{{ schedule.list }}</td>
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
    name: 'scheduleSort',
    components: {
        draggable,
        
    },
    props: ["scheduledata"],
    data() {
        return {
            scheduleOrder: this.scheduledata,
        };
    },
    methods: {
        update() {
            this.scheduleOrder.map((schedule, index) => {
                schedule.list = index + 1;
            });

            axios
                .post("schedules_properties_sort", {
                    scheduledata: this.scheduleOrder,
                })
                .then((response) => {
                    //success message
                });
        },
    },
    mounted() {
        console.log(this.scheduledata);
        //(this.name = this.scheduleData.name), (this.pdf = this.scheduleData.pdf);
    },
};
</script>
