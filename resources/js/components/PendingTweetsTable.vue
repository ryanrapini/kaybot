<template>
    <div class="card">
        <div class="card-header">Pending Tweets</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Tweet</th>
                                <th style="width:120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(pendingTweet, index) in pendingTweets" :key="index">
                                <td><blockquote>{{ pendingTweet.tweet }}</blockquote></td>
                                <td>
                                    <button type="button" class="btn btn-warning" @click="deletePendingTweet(index)">X
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            pendingTweets: []
        };
    },

    created: function() {
        this.$bus.on('reload-pending-tweets', this.fetchPendingTweets);
    },

    beforeDestroy() {
        this.$bus.off('reload-pending-tweets', this.fetchPendingTweets);
    },

    mounted: function() {
        this.fetchPendingTweets();
    },

    methods: {
        fetchPendingTweets: function() {
            axios.get(Laravel.baseUrl + '/generated-tweets')
                .then((resp) => {
                    this.pendingTweets = resp.data;
                });
        },
        deletePendingTweet: function(index) {
            var id = this.pendingTweets[index].id;
            axios.delete(Laravel.baseUrl + '/generated-tweets/' + id)
                .then((resp) => {
                    this.fetchPendingTweets();
                });
        }
    }
};
</script>
