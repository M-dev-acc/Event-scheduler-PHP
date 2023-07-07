import Modal from "./components/Modal.js";

document.addEventListener('DOMContentLoaded', event => {
    const dateCellsList = document.querySelectorAll(".calendar__month--date[aria-disabled='false']")
    
    dateCellsList.forEach(dateCell => {
        dateCell.addEventListener('click', event => {
            // console.log(dateCell)

            // Create a new instance of the Modal class
            const modal = new Modal("#eventsModal");
            modal.open();

        })
    })

})