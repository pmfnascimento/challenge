<template>
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Last Managers</strong> <a class="btn btn-success float-right" href="/managers/drivers/create">Create +</a></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">nº Cars</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="driver in drivers" :key="driver.driver_id">
                                <td class="text-center">{{ driver.name }}</td>
                                <td class="text-center">{{ driver.email }}</td>
                                <td class="text-center">{{ driver.car_count }}</td>
                                <td class="text-center">{{ driver.created_at }}</td>
                                <td class="text-center">
                                    <a :href="`/managers/drivers/${driver.driver_id}/edit/`" class="btn btn-secondary btn-sm">Edit+ </a>
                                    <button class="btn btn-danger btn-sm" @click.prevent="removeDriver(driver.driver_id)">Delete +</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
            drivers: []
        }
    },
    mounted() {

        axios.get('/api/managers/getDrivers/' + this.user)
            .then((response) => {
                this.drivers = response.data;

            }).catch(error => {});
    },
    methods: {

        removeDriver(id) {
            axios.post('/api/managers/destroy/' + id)
                .then((response) => {
                    location.reload();
                }).catch(error => {

                });
        }

    }
}
</script>
