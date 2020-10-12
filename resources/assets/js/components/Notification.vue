<template>
                     <div class="dropdown">
                        <button class="btn btn-block dropdown-toggle" type="button" id="notificationButton" style="text-align: left;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Notification
                             <span class="badge text-danger" v-if="unreadNotifications.length > 0 " > {{unreadNotifications.length}} </span>

                             <span class="badge" style="color:#0000008c;" v-if="unreadNotifications.length == 0 " > {{unreadNotifications.length}} </span>
                             
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="notificationButton" role="menu">
                            <Notification_Item v-for="unread in unreadNotifications" :key="unread.id" :unread="unread"></Notification_Item>
                            <li class="dropdown-item pl-2" v-if="unreadNotifications.length < 1 "> No notification available at this time. </li>
                        </ul>
                    </div>
</template>

<script>
    import Notification_Item from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid'],
        components: {Notification_Item},
        data(){
            return {
                unreadNotifications: this.unreads
            }
        },
        methods: {
         
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                    let newUnreadNotifications = {data: {application: notification.application}};
                    this.unreadNotifications.push(newUnreadNotifications);
                });

        }
    }
</script>