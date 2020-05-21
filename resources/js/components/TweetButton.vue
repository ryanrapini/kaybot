<template>
    <div class="card">
        <div class="card-header">Send a Tweet</div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h6>Min Delay: <strong>{{ settings.min_delay }}</strong></h6>
                    <h6>Max Delay: <strong>{{ settings.max_delay }}</strong></h6>
                    <h6>Next Tweet: <strong>{{ settings.next_tweet }}</strong></h6>
                </div>
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
            status: '',
            settings: {
                'min_delay': 0,
                'max_delay': 0,
                'last_time': 0,
                'next_tweet': 0,
            }
        };
    },


    created: function() {

    },
    mounted: function() {
        this.getSettings();

        window.setInterval(() => {
            this.calcTime()
        }, 1000);
    },
    methods: {
        doTweet: function() {
            axios.get(Laravel.baseUrl + '/actions/tweet')
                .then((resp) => {
                    this.status = resp.data;
                    this.$bus.emit('reload-pending-tweets');
                    this.$bus.emit('reload-live-tweets');
                });
        },

        getSettings: function() {
            axios.get(Laravel.baseUrl + '/settings')
                .then((resp) => {
                    resp.data.forEach((setting) => {
                        if(setting.name === 'min_delay'){
                            this.settings.min_delay = setting.value;
                        }
                        if(setting.name === 'max_delay'){
                            this.settings.max_delay = setting.value;
                        }
                        if(setting.name === 'last_time'){
                            this.settings.last_time = setting.value;
                        }
                    });
                    
                })
        },

        calcTime: function() {
            var next_tweet_time = moment.unix(this.settings.last_time);
            var current_time = moment();
            if(current_time.isAfter(next_tweet_time)){
               this.settings.next_tweet = 'Tweeting...';
               this.getSettings();
            }
            else {
                this.settings.next_tweet = current_time.to(next_tweet_time);
            }
        }
    }
};
</script>
