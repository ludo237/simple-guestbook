// Common headers used by Laravel when submit POST|PUT|PATCH|DELETE requests
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

/**
 * VueJS instance for the guestbook DOMNode
 */
var guestbook = new Vue({
    // Bind this instance to the Dom element
    el: '#guestbook',

    // Data needed
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

    // This method is triggered as soon as the web page is ready
    ready: function() {
        this.fetchMessages();
    },

    methods: {
        // Fetch all messages using API
        fetchMessages: function() {
            this.$http.get('/api/messages', function(messages) {
                // this.messages = messages is the same
                // but $set is useful when you don't have a variable in data
                this.$set('messages', messages);
            });
        },

        // Submit the form
        onSubmitForm: function(e) {
            e.preventDefault();
            // Save the current instance of the message sent from the user
            var message = this.newMessage;
            // Reset the form
            this.newMessage = { name: '', message: '' };
            // Call the post API with params message and a callback for the response
            this.$http.post('api/messages', message, function(response){
                // If everything goes well we have to alert the user about it
                this.submitted = true;
                this.response = response;
                // Synchronize the DOM with all new messages
                this.fetchMessages();
            }).error(function(errorResponse){
                // Errors during POST
                console.log(errorResponse);
                alert("Failed to insert your message");
            });

        }
    }
});
