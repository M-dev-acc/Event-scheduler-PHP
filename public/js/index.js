document.addEventListener('DOMContentLoaded', event => {
    const dateCellsList = document.querySelectorAll(".calendar__month--date[aria-disabled='false']")
    
    dateCellsList.forEach(dateCell => {
        dateCell.addEventListener('click', event => {
            console.log(dateCell)

        })
    })

})