<template>
    <div class="card">
        <div class="card-header">Live Tweets</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Tweet</th>
                                <th style="width:20%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(liveTweet, index) in liveTweets" :key="index">
                                <td><blockquote>{{ liveTweet.text }}</blockquote></td>
                                <td>
                                    {{ liveTweet.created_at }}
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
            liveTweets: []
        };
    },

    created: function() {
        this.$bus.on('reload-live-tweets', this.fetchLiveTweets);
    },

    beforeDestroy() {
        this.$bus.off('reload-live-tweets', this.fetchLiveTweets);
    },

    mounted: function() {
        this.fetchLiveTweets();
    },

    methods: {
        fetchLiveTweets: function() {
            axios.get(Laravel.baseUrl + '/live-tweets')
                .then((resp) => {
                    this.liveTweets = resp.data;
                });
        },
        deletePendingTweet: function(index) {
            var id = this.liveTweets[index].id;
            axios.delete(Laravel.baseUrl + 'generated-tweets/' + id)
                .then((resp) => {
                    this.fetchLiveTweets();
                });
        }
    }
};
</script>
