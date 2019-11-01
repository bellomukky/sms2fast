

require('./bootstrap');

import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll);

window.Vue = require('vue');




Vue.component('message-component', require('./components/MessageComponent.vue').default);

const app = new Vue({
    el: '#app',
    mounted(){
        Echo.private('ChatChannel')
            .listen('ChatBroadcastEvent', (e) => {
                this.chat.messages.push(e.message);
                this.chat.users.push(e.user);
                this.chat.colors.push("warning");
            });
    },
    data:{
        message:'',
        chat:{
            messages:[],
            colors:[],
            users:[]
        }
    },
    methods:{
        send(){
            if(this.message.length > 0){
                axios.post("/send")
                .then(response=>{
                    this.chat.messages.push(this.message);
                    this.chat.users.push("You");
                    this.chat.colors.push("success")
                    this.message = ""; 
                })
                .error(error=>{
                    console.log(error);
                });
               
                
            }
           
        }
    }
});
