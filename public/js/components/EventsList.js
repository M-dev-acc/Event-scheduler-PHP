import Http from "./Ajax.js";
import Modal from "./Modal.js";

class EventsList {

    constructor(eventListsJsonObject) {
        this.baseURL = window.location.origin;
        const templatesContainer = document.getElementById('htmlTemplates');
        this.templateClones = document.importNode(templatesContainer.content, true);
        this.listItemTemplate = this.templateClones.querySelector('#eventItem');
        this.eventListsJsonObject = eventListsJsonObject;
    }

    getEventsListHtml() {
        const list = this.templateClones.querySelector('dialog#eventsModal #modalContent #eventsList');

        this.eventListsJsonObject.forEach(event => {
            const listItem = this.createListitem(event.id, event.name, event.status, event.time)
            list.appendChild(listItem);
        });
        
        return list;
    }

    createListitem(eventId, eventTitle, eventStatus, eventTime) {
        
        const listItemClone = this.listItemTemplate.cloneNode(true);
        const listItemText = listItemClone.querySelector('span[data-child-role="event-text"]');
        const listItemUpdateStatusButton = listItemClone.querySelector('button[data-child-role="mark-btn"]');
        listItemText.innerText = eventTitle;

        listItemUpdateStatusButton.setAttribute('data-reference', eventId);

        listItemUpdateStatusButton.innerText = (eventStatus) ? "Mark not done" : "Mark as done" ;
        
        listItemText.addEventListener('click', event => {
            event.preventDefault();

            window.location = `${this.baseURL}/Calendar/actions/edit-event.php?event=${eventId}`
        });

        listItemUpdateStatusButton.addEventListener('click', event => {
            const clickedButton = event.target;
            const eventId = clickedButton.dataset.reference;
            console.log(eventId);
            let formDataObject = new FormData();
            formDataObject.append('event', eventId);

            const ajaxHelper = new Http();
            const addEventPromise = ajaxHelper.post(`${this.baseURL}/Calendar/actions/update-status.php`, formDataObject);
            addEventPromise.then(response => {
                alert(response.message);
                
                const modal = new Modal('dialog#eventsModal', eventTime);
                console.log(modal);
                modal.refreshModalContent();

                listItemUpdateStatusButton.innerText = (response.data.event_status) ? "Mark not done" : "Mark as done" ;
            });
            
        });

        return listItemClone;
    }
}

export default EventsList;