<template>
    <li class="dropdown-item pl-2"> 
        <a :href="threadUrl" v-if="unread.data.application.applicant_name!='' ">
           {{ unread.data.application.applicant_name }} applied for sticker
        </a>
       
    </li>
</template>

<script>
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            this.threadUrl="/application-review-from-notfication/"+this.unread.data.application.app_number+'/'+this.unread.id
        }

    }
</script>