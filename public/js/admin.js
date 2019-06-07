let banUserBtn = document.querySelectorAll('.banUser');
let archiveUserBtn = document.querySelectorAll('.archiveUser');

if(banUserBtn!=null){
banUserBtn.forEach(element => {
    element.onclick = function(){
        let id_report = element.getAttribute('repid');
        sendAjaxRequest("put",'/report/'+ id_report+'/accept',null,acceptBanUserHandler); 
    }
});
}


if(archiveUserBtn!=null){
    archiveUserBtn.forEach(element => {
        element.onclick = function(){
            let id_report = element.getAttribute('archid');
            sendAjaxRequest("put",'/report/'+ id_report+'/archive',null,archiveBanUserHandler); 
        }
    });
    }
    

function acceptBanUserHandler(){
    console.log(JSON.parse(this.response));
    if(this.status==200){
        let response = JSON.parse(this.response);
        let alert = document.createElement('div');

        let id = "footer"+response['id_report'];
        document.getElementById(id).innerHTML = "Approved";
        let oldCard = document.getElementById(response['id_report']).cloneNode(true);

        alert.innerHTML = '<div id="ticketAlert" class="alert alert-success" role="alert"> User banned!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
        document.getElementById(response['id_report']).replaceWith(alert);
        document.getElementById('archivedUsers').prepend(oldCard);
    }
}

function archiveBanUserHandler(){
    if(this.status==200){
        let response = JSON.parse(this.response);
        let alert = document.createElement('div');

        let id = "footer"+response['id_report'];
        document.getElementById(id).innerHTML = "Ignored";
        let oldCard = document.getElementById(response['id_report']).cloneNode(true);

        alert.innerHTML = '<div id="ticketAlert" class="alert alert-success" role="alert"> Successfully ignored!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
        document.getElementById(response['id_report']).replaceWith(alert);
        document.getElementById('archivedUsers').prepend(oldCard);
    }
}

let deleteEventBtn = document.querySelectorAll('.delete-event');
let archiveEventBtn = document.querySelectorAll('.archive-event');

if(deleteEventBtn!=null){
    deleteEventBtn.forEach(element => {
        element.onclick = function(){
            let id_report = element.getAttribute('repid');
            console.log("put",'/report/'+ id_report+'/archive');
            sendAjaxRequest("put",'/report/'+ id_report+'/accept',null,acceptDeleteEventHandler); 
            element.parentNode.parentNode.removeChild( element.parentNode);
        }
    });
    }
    
    
    if(archiveEventBtn!=null){
        archiveEventBtn.forEach(element => {
            element.onclick = function(){
                let id_report = element.getAttribute('archid');
                console.log("put",'/report/'+ id_report+'/archive');
                sendAjaxRequest("put",'/report/'+ id_report+'/archive',null,archiveEventHandler); 
                element.parentNode.parentNode.removeChild( element.parentNode);
            }
        });
        }
function acceptDeleteEventHandler(){
    console.log(JSON.parse(this.response));
}

function archiveEventHandler(){
    if(this.status==200){
        let response = JSON.parse(this.response);
        let alert = document.createElement('div');

        let id = "footer"+response['id_report'];
        document.getElementById(id).innerHTML = "Ignored";
        let oldCard = document.getElementById(response['id_report']).cloneNode(true);

        alert.innerHTML = '<div id="ticketAlert" class="alert alert-success" role="alert"> Successfully ignored!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        
        document.getElementById(response['id_report']).replaceWith(alert);
        document.getElementById('archivedUsers').prepend(oldCard);
    }
}