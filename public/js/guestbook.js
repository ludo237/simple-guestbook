Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({
    el: '#guestbook',

    data: {
        newMessage: { name: '', message: '' },
        submitted: false,
        messages: [],
        response: ''
    },

    computed: {
        errors: function() {
            for (var key in this.newMessage) {
                if ( ! this.newMessage[key]) return true;
            }

            return false;
        }
    },

    ready: function() {
        this.fetchMessages();
    },

    methods: {
        fetchMessages: function() {
            this.$http.get('/api/messages', function(messages) {
                this.$set('messages', messages);
            });
        },

        onSubmitForm: function(e) {
            e.preventDefault();

            var message = this.newMessage;
            this.newMessage = { name: '', message: '' };

            this.$http.post('api/messages', message, function(response){
                this.messages.push(message);
                this.submitted = true;
                this.response = response;
            }).error(function(errorResponse){
                console.log(errorResponse);
                alert("Failed to insert your message");
            });

        }
    }
});
