<input
    type="hidden"
    name="get-comments-url"
    value="{{ route('jobs.comments.index', ['job' => $job]) }}"
>
<input
    type="hidden"
    name="base-asset-url"
    value="{{ asset('') }}"
>
<input
    type="hidden"
    name="default-avatar"
    value="{{ asset('bower_components/job_light/images/avatar.png') }}"
>
<input
    type="hidden"
    name="current-user-id"
    value="{{ Auth::id() }}"
>
<input
    type="hidden"
    name="update-comment-url"
    value="{{ route('comments.update') }}"
>
<input
    type="hidden"
    name="delete-comment-url"
    value="{{ route('comments.destroy') }}"
>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="jp_blog_single_comment_main_wrapper">
        <div class="jp_blog_single_comment_main">
            <h2>{{ __('messages.comment') }}</h2>
        </div>
        <div class="jp_blog_single_comment_box_wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_blog_comment_main_section_wrapper"></div>
                </div>
            </div>
        </div>
    </div>
    <form
        id="create-comment"
        class="jp_blog_single_form_main_wrapper"
        action="{{ route('jobs.comments.store', ['job' => $job]) }}"
        method="post"
    >
        @csrf
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="jp_contact_inputs_wrapper jp_contact_inputs4_wrapper">
                    <textarea rows="6" name="content"></textarea>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-plus-circle"></i>
                    {{ __('messages.comment') }}
                </button>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('comments.update') }}" method="post" id="edit-comment">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="comment_id">
                    <h4 class="m-b-15">{{ __('messages.edit-comment') }}</h4>
                    <div class="jp_contact_inputs_wrapper jp_contact_inputs4_wrapper">
                        <textarea
                            id="edit-comment"
                            rows="6"
                            name="content"
                        ></textarea>
                    </div>
                    <div class="m-t-20 text-right">
                        <button class="btn btn-default" data-dismiss="modal">
                            {{ __('messages.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{ __('messages.confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('comments.destroy') }}" method="post" id="delete-comment">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="comment_id">
                    <h4 class="m-b-15">{{ __('messages.confirmation') }}</h4>
                    <p>{{ __('messages.sure-confirm') }}</p>
                    <div class="m-t-20 text-right">
                        <button class="btn btn-default" data-dismiss="modal">
                            {{ __('messages.cancel') }}
                        </button>
                        <button class="btn btn-success">
                            {{ __('messages.confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
