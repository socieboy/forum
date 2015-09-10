<script src="https://js.pusher.com/2.2/pusher.min.js"></script>
<script>
    this.pusher = new Pusher('bc72a867a66b607414e1');

    this.pusherChannel = this.pusher.subscribe('socieboy-forum-channel-' + {{ auth()->user()->id}});

    this.pusherChannel.bind('Socieboy\\Forum\\Events\\NewReply', function(message) {
        console.log(message.user);
    });
</script>