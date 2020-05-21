<template>
    <div class="card">
        <div class="card-header">Load Tweets</div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Paste Tweets Here</h5>
                    <div class="input-group">
                        <textarea style="height:400px" class="form-control" v-model="tweets"></textarea>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="is-multi-tweet" v-model="isMultipleTweets">
                      <label class="form-check-label" for="is-multi-tweet">
                        Multiple Tweets (one per line)
                      </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" @click="saveTweets">Save</button>
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
            status: '',
            tweets: '',
            isMultipleTweets: true,
        };
    },


    created: function() {

    },
    mounted: function() {
    },
    methods: {
        saveTweets: function() {
            if(this.isMultipleTweets){
                axios.post('/generated-tweets/store-many', { tweets: this.tweets })
                    .then((resp) => {
                        this.status = resp.data;
                        this.$bus.emit('reload-pending-tweets');
                    });    
            }
            else {
                axios.post('/generated-tweets', { tweets: this.tweets })
                    .then((resp) => {
                        this.status = resp.data;
                        this.$bus.emit('reload-pending-tweets');
                    });
            }
        }
    }
};
</script>
