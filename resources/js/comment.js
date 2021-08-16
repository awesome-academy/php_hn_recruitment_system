$(() => {
    const getCommentsUrl = $('input[name="get-comments-url"]').val();
    const baseAssetUrl = $('input[name="base-asset-url"]').val();
    const defaultAvatar = $('input[name="default-avatar"]').val();
    const currentUserId = $('input[name="current-user-id"]').val();
    const csrfToken = $('input[name="_token"]').val();

    const commentWrapper = $('.jp_blog_single_comment_box_wrapper');

    const headers = {
        'X-CSRF-TOKEN': csrfToken,
    };

    sendGetCommentsRequest().then((comments) => {
        renderComments(comments);
    });

    // Handle submit create comment form
    $('form#create-comment').on('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        const url = event.target.action;

        sendCreateCommentRequest(url, formData)
            .then((comment) => {
                renderNewComment(comment);
            })
            .catch((error) => console.table(error));

        event.target.reset();
    });

    // Prepare for edit comment
    $(document).on('click', 'button#edit-comment', function () {
        const commentId = $(this).val();
        const content = $(`.comment#${commentId} p.content`).text();
        console.log(content);
        $('textarea#edit-comment').val(content);
        $('form#edit-comment input[name="comment_id"]').val(commentId);
    });

    // Handle submit edit comment form
    $('form#edit-comment').on('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const url = event.target.action;

        sendUpdateCommentRequest(url, formData).then(({ id, content }) => {
            $(`.comment#${id} p.content`).text(content);
        });
        $('#modal-edit').modal('hide');
        $('.modal-backdrop').remove();
    });

    // Prepare for delete comment
    $(document).on('click', 'button#delete-comment', function () {
        const commentId = $(this).val();
        console.log(commentId);
        $('form#delete-comment input[name="comment_id"]').val(commentId);
    });

    // Handle confirm delete comment
    $('form#delete-comment').on('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const url = event.target.action;
        const commentId = $(
            'form#delete-comment input[name="comment_id"]'
        ).val();

        sendDeleteCommentRequest(url, formData).then(() => {
            $(`.comment#${commentId}`).remove();
        });
        $('#modal-delete').modal('hide');
        $('.modal-backdrop').remove();
    });

    // Extract comment from raw comment returned by server
    function extractComment(rawComment) {
        const {
            id,
            content,
            created_at: createdAt,
            user_id: userId,
            employee_profile: employeeProfile,
            employer_profile: employerProfile,
        } = rawComment;
        const name = employerProfile?.name || employeeProfile?.name;
        const avatar =
            employerProfile?.logo.replace(/^public/, 'storage') ||
            `images/${employeeProfile?.avatar}`;

        return { id, content, createdAt, userId, name, avatar };
    }

    function renderComments(comments) {
        const commentElements = comments.map((comment) => {
            const canEdit = comment.userId == currentUserId;

            return createCommentElement(comment, canEdit);
        });

        if (commentWrapper !== null) {
            commentWrapper.append(...commentElements);
        }
    }

    function renderNewComment(comment) {
        const canEdit = comment.userId == currentUserId;
        const commentElement = createCommentElement(comment, canEdit);
        commentWrapper.append(commentElement);
    }

    function createCommentElement(
        { id, content, createdAt, name, avatar },
        canEdit
    ) {
        let actionsHtml = '';
        if (canEdit) {
            actionsHtml = `
                <div class="comment-action-wrapper">
                    <button
                        id="edit-comment"
                        class="unstyled cursor-pointer"
                        value=${id}
                        data-toggle="modal"
                        data-target="#modal-edit"
                    >
                        <i class="mdi mdi-pencil"></i>
                    </button>
                    <button
                        id="delete-comment"
                        class="unstyled cursor-pointer"
                        value=${id}
                        data-toggle="modal"
                        data-target="#modal-delete"
                    >
                        <i class="mdi mdi-delete"></i>
                    </button>
                </div>`;
        }

        return `
            <div class="row comment" id="${id}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_blog_comment_main_section_wrapper">
                        <div class="jp_blog_sin_com_img_wrapper">
                            <img
                                src="${baseAssetUrl}${avatar}"
                                onerror="this.src = '${defaultAvatar}'"
                            >
                        </div>
                        <div class="jp_blog_sin_com_cont_wrapper">
                            <ul>
                                <li>
                                    <i class="fa fa-user"></i>
                                    <span>${name}</span>
                                </li>
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <span>${createdAt}</span>
                                </li>
                            </ul>
                            <p class="content">${content}</p>
                        </div>
                        ${actionsHtml}
                    </div>
                </div>
            </div>`;
    }

    function sendGetCommentsRequest() {
        return new Promise((resolve, reject) => {
            fetch(getCommentsUrl)
                .then((response) => response.json())
                .then((rawComments) => {
                    const comments = rawComments.map((rawComment) =>
                        extractComment(rawComment)
                    );
                    resolve(comments);
                })
                .catch((error) => reject(error));
        });
    }

    function sendCreateCommentRequest(url, formData) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: 'post',
                headers: headers,
                body: formData,
            })
                .then((response) => response.json())
                .then((rawComment) => {
                    const comment = extractComment(rawComment);
                    resolve(comment);
                })
                .catch((error) => reject(error));
        });
    }

    function sendUpdateCommentRequest(url, data) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: 'post',
                headers: headers,
                body: data,
            })
                .then((response) => resolve(response.json()))
                .catch((error) => reject(error));
        });
    }

    function sendDeleteCommentRequest(url, data) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: 'post',
                headers: headers,
                body: data,
            })
                .then((response) => resolve(response.json()))
                .catch((error) => reject(error));
        });
    }
});
