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
            const listItem = this.createListitem(event.id, event.name)
            list.appendChild(listItem);
        });
        
        return list;
    }

    createListitem(eventId, eventTitle) {
        
        const listItemClone = this.listItemTemplate.cloneNode(true);
        const listItemText = listItemClone.querySelector('span[data-child-role="event-text"]');
        listItemText.innerText = eventTitle;

        listItemClone.setAttribute('data-reference', eventId);

        listItemClone.addEventListener('click', event => {
            event.preventDefault();

            window.location = `${this.baseURL}/Calendar/actions/edit-event.php?event=${eventId}`
        })

        return listItemClone;
    }
}

export default EventsList;