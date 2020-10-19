<script>
new Vue({
    el: '#chat',
    filters: {
        dateTime: function(date) {
            return moment(date).format('MM/DD-HH:MM');
        },
    },
    data: {
        message: '',
        messages: [],
        member_id: document.getElementById('member_id').value,
        room_id: document.getElementById('room_id').value,
    },
    methods: {
        getMessages() {
            const url = '/ajax/message/' + this.room_id;
            axios.get(url)
                .then((response) => {
                    this.messages = response.data;
                });
        },
        send() {
            const url = '/ajax/message';
            const params = {
                message: this.message,
                member_id: this.member_id,
            };
            axios.post(url, params)
                .then((response) => {
                    this.message = '';
                });
        },
    },
    mounted() {
        this.getMessages();

        Echo.channel('chat').listen('MessageCreated', (e) => {
            this.getMessages();
        });
    },
});
</script>