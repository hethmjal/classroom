import './bootstrap';
import './mycharts.js';

/* import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
 */
/* 
if(classroomId ?? false){
    Echo.private('classroom.' + classroomId)
    .listen('.classwork-created',function (data) {
        alert(data.title);
    })
    
} */
function addMessage(message,prepend = false){
    let html = `
        <div class="bg-info rounded p-2 mt-2 ">
            <div>
                <b>${message.sender.name}</b> - <span class="text-muted">${message.sent_at}</span> 
            </div>

            <div>
                ${message.body}    
            </div>
        </div>`;
        if(prepend){
            return $('#messages').prepend(html);
        }
        $('#messages').append(html);
        const element = document.getElementById("messages");
        element.scrollTop = element.scrollHeight;
}
Echo.private('App.Models.User.' + userId)
    .notification(function (event) {
        alert(event.title)
    })

console.log(classroomId);
Echo.join(`classroom.${classroomId}`)
    .here((users) => {
        console.log(users);
    })
    .joining((user) => {
        console.log('joining');
        console.log(user);
    })
    .leaving((user) => {
        console.log('leaving');
        console.log(user); 
       })
    .listen('.new-message', (event) => {
        //alert(event);
        console.log(event); 
        
        addMessage(event)
    }); 