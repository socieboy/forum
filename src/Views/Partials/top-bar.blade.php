    <form action="{{ url('forum/search') }}" method="POST">

        {!! csrf_field() !!}

        <div class="row">

            <div class="col-md-offset-7 col-md-5">
                <div class="form-group">
                    <input id="forum-search" type="text" placeholder="{{ trans('Forum::messages.search') }}" name="title" class="form-control"/>
                </div>
            </div>

        </div>

    </form>



