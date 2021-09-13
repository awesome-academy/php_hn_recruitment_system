import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

const userId = $('input[name="user-id"]').val();

echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        renderNewNotification({
            ...notification,
            read: false,
            created_at: '',
        });
    });

$(async () => {
    const notifications = await getAllNotifications();
    renderAllNotifications(notifications);
    renderNotificationsCounter(notifications.length);
});

function createNotificationElement({
    message,
    target_url: targetUrl,
    read,
    created_at: createdAt
}) {
    return `
        <li class="list-item border bottom ${read ? 'read' : 'unread'}">
            <a href="${targetUrl}" class="media-hover p-15">
                <div class="media-img">
                    <div class="icon-avatar bg-primary">
                        <i class="ti-settings"></i>
                    </div>
                </div>
                <div class="info">
                    <span class="title">
                        ${message}
                    </span>
                    <span class="sub-title">
                        ${createdAt}
                    </span>
                </div>
            </a>
        </li>`
}

function renderNewNotification(notification) {
    const notificationElement = createNotificationElement(notification);

    $('.notifications .list-media').prepend(notificationElement);
}

async function getAllNotifications() {
    const response = await fetch('/notifications');

    return response.json();
}

function renderAllNotifications(notifications) {
    const notificationElements = notifications.map(createNotificationElement);

    $('.notifications .list-media').html(notificationElements);
}

function renderNotificationsCounter(counter) {
    if (counter > 0) {
        $('.notifications').prepend(`<span class="counter">${counter}</span>`)
    }
}
