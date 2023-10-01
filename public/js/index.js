import Modal from "./components/Modal.js";
import Http from "./components/Ajax.js";
import EventsList from "./components/EventsList.js";

document.addEventListener('DOMContentLoaded', event => {
    const dateCellsList = document.querySelectorAll(".calendar__month--date[aria-disabled='false']")
    
    dateCellsList.forEach(dateCell => {
        let today = new Date().toLocaleDateString();
        let dateCellDate = dateCell.dataset.date;
        let [year, month, date] = dateCellDate.split('-');
        
        let dateCellDateObject = new Date(`${month}/${date}/${year}`).toLocaleDateString();
        
        if (today == dateCellDateObject) {
            dateCell.style.backgroundColor = '#899de4';
        }

        dateCell.addEventListener('click', event => {
            // Create a new instance of the Modal class
            const selectedDate = dateCell.dataset.date;
            const modal = new Modal("#eventsModal", selectedDate);
            modal.open();

        });
    });


    
})