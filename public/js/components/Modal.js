import Http from "./Ajax.js";
import EventsList from "./EventsList.js";

class Modal{
    /**
     * Set properties to the class
     * 
     * @param {string} modalId 
     */
    constructor(modalId, selectedDate) {
        this.templatesContainer = document.getElementById('htmlTemplates');
        const templateClones = document.importNode(this.templatesContainer.content, true);
        this.modal = templateClones.querySelector(modalId);

        this.selectedDate = selectedDate;
        this.baseURL = window.location.origin;

        this.initialize(this.modal);
    }
    
    /**
     * Initialize the modal
     * 
     * @param {Node} modal 
     */
    initialize(modal) {
        document.body.appendChild(modal);
        const closeBtns = modal.querySelectorAll("button[aria-label='Close']");
        closeBtns.forEach(closeBtn => {
            closeBtn.addEventListener('click', () => this.close());
        });
        this.initializeAddEventForm();
        this.appendEventsListHtml();
    }

    /**
     * Open the modal
     */
    open() {
        this.modal.showModal();
    }

    /**
     * Close modal
     */
    close() {
        this.modal.close();
    }

    /**
     * Add Html content into the modal
     * 
     * @param {Node} content 
     */
    addModalContent(content) {
        const modalBody = this.modal.querySelector("main#modalContent");
        modalBody.appendChild(content);
    }

    /**
     * Add Events list into the modal
     */
    appendEventsListHtml(){
        // Get event list from the server
        const ajaxHelper = new Http();
        const getEventsData = ajaxHelper.get(`${this.baseURL}/Calendar/actions/show-events.php?date=${this.selectedDate}`);
        
        getEventsData.then((response) => {
            const eventsList = new EventsList(response.data);
            this.addModalContent(eventsList.getEventsListHtml());
        });
    }

    /**
     * Set values into form inputs
     */
    initializeAddEventForm() {
        const form = this.modal.querySelector('form#addEventForm');
        const hiddenEventDateInput = form.querySelector('#eventDateInput');
        hiddenEventDateInput.value = this.selectedDate;

        form.addEventListener('submit', event => {
            event.preventDefault();

            let formData = new FormData(form);
            const ajaxHelper = new Http();
            const addEventPromise = ajaxHelper.post(`${this.baseURL}/Calendar/actions/create-event.php`, formData);
            addEventPromise.then(response => {
                form.reset();
                alert(response.message);
                // refresh eventlist data
                // show success notification
            });
        });
    }
}

export default Modal;