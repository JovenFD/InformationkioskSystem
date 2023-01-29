
function TeacherEvents() {

    this.msgTeacherEvents = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }
    
    this.fetchTeacherEvents = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&EventsLandingPageview", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let row = ``;

            message.forEach(el => {
                let month = new Date(el.start).toLocaleString("default", { month: "short" });
                let day = new Date(el.start).getDate();

                row += `
                    <div class="row m-2">
                        <div style="color: ${el.color};" class="col-3 mb-2 top-3 rounded-l-md h-32">
                            <div class="bg-red-800 rounded-lg w-full py-4 block h-full shadow-inner">
                                <div class="text-center tracking-wide">
                                <div class="text-white font-bold text-4xl ">${day}</div>
                                <div class="text-white font-normal text-2xl">${month}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col mb-2 top-3 h-32 rounded-lg shadow-inner bg-gray-100 border-2 border-red-900">
                            <div style="color: ${el.color}" class="font-semibold text-gray-800 text-xl text-center lg:text-left px-2 py-5">
                                ${el.title}
                            </div>
                        </div> 
                    </div>
                `;
            });

            document.querySelector('#eventList').innerHTML = row;
        } else {
            this.msgTeacherEvents(message, 'error'); 
        }
    } 
}

let eventsObj = new TeacherEvents();
eventsObj.fetchTeacherEvents();