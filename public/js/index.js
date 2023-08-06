import Modal from "./components/Modal.js";
import Http from "./components/Ajax.js";
import EventsList from "./components/EventsList.js";

document.addEventListener('DOMContentLoaded', event => {
    const dateCellsList = document.querySelectorAll(".calendar__month--date[aria-disabled='false']")
    
    dateCellsList.forEach(dateCell => {
        dateCell.addEventListener('click', event => {
            
            // Create a new instance of the Modal class
            const modal = new Modal("#eventsModal");

            const selectedDate = dateCell.dataset.date;
            const baseURL = window.location.origin;
            
            // Get event list from the server
            const ajaxHelper = new Http();
            const getEventsData = ajaxHelper.get(`${baseURL}/Calendar/actions/show-events.php?date=${selectedDate}`);
            
            getEventsData.then((response) => {
                const eventsList = new EventsList(response.data);
                modal.addModalContent(eventsList.getEventsListHtml())
            });
            
            modal.open();
        })
    })

})