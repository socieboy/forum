@if(auth()->check())
    <div class="forum-notification">
        <a href="#">
            <span></span>
        </a>
    </div>
    <script src="https://js.pusher.com/2.2/pusher.min.js"></script>
    <script>
        this.pusher = new Pusher('{{ env('PUSHER_KEY') }}');

        this.pusherChannel = this.pusher.subscribe('socieboy-forum-channel-' + {{ auth()->user()->id }});

        this.pusherChannel.bind('Socieboy\\Forum\\Events\\NewReply', function(message) {
             var user = message.user;
             var link = message.link;
             console.log(user);
             console.log(link);
            $('div.forum-notification a span').text(user + ' {{ trans('Forum::messages.notification-reply') }}');
            $('div.forum-notification a').attr('href', link);
            $('div.forum-notification').css('display', 'block');
        });
    </script>
@endif