<template>
    <div class="card">
        <div class="card-header">Send a Tweet</div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" @click="doTweet">Tweet</button>
                </div>
                <div class="col-md-12">
                    {{ status }}
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>

export default {
    components: {
        
    },
    data: function() {
        return {
            status: ''
        };
    },


    created: function() {

    },
    mounted: function() {
    },
    methods: {
        doTweet: function() {
            axios.get('/actions/tweet')
                .then((resp) => {
                    this.status = resp.data;
                    this.$bus.emit('reload-pending-tweets');
                    this.$bus.emit('reload-live-tweets');
                });
        }
    }
};
</script>
