<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta id="token" name="token" value="{{ csrf_token() }}">
        <title>Simple Guestbook</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/guestbook.css"/>
    </head>
    <body>
        <div class="container" id="guestbook">
            <div class="row">
                <div class="col-md-4">
                    <form accept-charset="UTF-8" action="api/messages" enctype="multipart/form-data" method="POST"
                          role="form" v-on="submit: onSubmitForm">
                        <legend>Submit your message</legend>
                        <div class="form-group">
                            <label for="name">
                                <span>Nickname</span>
                                <span class="error" v-if="! newMessage.name">*</span>
                            </label>
                            <input autocomplete autofocus class="form-control" id="name" name="name"
                                   placeholder="Type your name or nickname..." required
                                   type="text" v-model="newMessage.name">
                        </div>
                        <div class="form-group">
                            <label for="message">
                                <span>Your Message</span>
                                <span class="error" v-if="! newMessage.message">*</span>
                            </label>
                            <textarea class="form-control" id="message" name="message"
                                      placeholder="What's up?" required
                                      type="text" v-model="newMessage.message"></textarea>
                        </div>
                        <div class="form-group" v-if="! submitted">
                            <button class="btn btn-default" type="submit" v-attr="disabled: errors">
                                Post your Message
                            </button>
                        </div>
                        <div class="alert alert-success" v-if="submitted">@{{ response }}</div>
                    </form>
                </div>
                <div class="col-md-7">
                    <header>Latest Messages</header>
                    <article class="panel panel-default" v-repeat="messages">
                        <div class="panel-heading">
                            <strong>From</strong>
                            <span class="text-capitalize">@{{ name }}</span>
                            <small class="text-muted">@{{ created_at }}</small>
                        </div>
                        <div class="panel-body">@{{ message }}</div>
                    </article>
                </div>
            </div>
        </div>
        <script src="/js/vendor.js" type="text/javascript"></script>
        <script src="/js/guestbook.js" type="text/javascript"></script>
    </body>
</html>
