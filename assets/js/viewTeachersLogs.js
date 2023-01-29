function ViewTeacherLogs () {

    this.msgViewTeacherLogs = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchViewTeacherLogs = async() => {
        const response = await fetch("./index.php?action=viewTeachersLog&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status } = await response.json();

        if(status == 'success') {
            this.tableBodyViewTeacherLogs(message);
        } else {
            this.msgViewTeacherLogs(message, 'error'); 
        }
    }

    this.SearchTeacher = () => {

        searchCheckListTeacher.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
 

            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`./index.php?action=viewTeachersLog`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyViewTeacherLogs(message);
                } else {
                    this.msgViewTeacherLogs(message, 'error'); 
                }

            } else {
                this.fetchViewTeacherLogs();
            }
        }
    }

    this.totalViewTeacherLogs = async() => {
        const response  = await fetch(`./index.php?action=viewTeachersLog&totalLogsTeacher`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationViewTeacherLogs(pagenumber -= 1);
                } 
            };

            next.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationViewTeacherLogs(pagenumber += 1);
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `
                    <div onclick="(checkListObj.paginationViewTeacherLogs(${i}))" class="child w-16 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in rounded-full">${i}</div>
                `;
            }

            document.querySelector('#viewListTeacherBtn').innerHTML = output;

            let elements = document.getElementsByClassName("child");

            for(let i = 0; i < elements.length; i++) {   
                elements[i].addEventListener('click', function(e) {
                    e.preventDefault();
                      
                    let el = elements[0];
                    
                    while(el) {
                        if(el.tagName == "DIV"){
                            //remove class
                            el.classList.remove("bg-red-700");
                        }
                        // pass to the new sibling
                        el = el.nextSibling;
                    }
                  this.classList.add("bg-red-700");  
                });
            }

        } else {
            this.msgViewTeacherLogs(message, 'error'); 
        }
    };

    this.paginationViewTeacherLogs = async(pagenum) => {
        const response = await fetch(`./index.php?action=viewTeachersLog&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyViewTeacherLogs(message);
        } else {
            this.msgViewTeacherLogs(message, 'error'); 
        }
    }

    this.tableBodyViewTeacherLogs = (data) => {
        let row = ``;
        let empVal = `                    
            <div tabindex="0" aria-label="card 1" class="focus:outline-none lg:w-full lg:mr-7 lg:mb-9 mb-7 bg-white p-6 shadow rounded-lg text-center animate-bounce">
                <h1>Data Not Found</h1>
            </div>
        `;

        if(data != true) {
            data.forEach(el => {
                let path = el.avatar;
                let date = new Date(el.created_date).toDateString();
                let time = new Date(el.created_date).toLocaleTimeString();

                row += `
                    <div tabindex="0" aria-label="card 1" class="focus:outline-none lg:w-full lg:mr-7 lg:mb-9 mb-7 bg-white p-6 shadow rounded-lg">
                        <div class="flex items-center border-b border-gray-200 pb-10">
                            <img src="${path.slice(1, path.length)}" alt="coin avatar" class="w-12 h-12 rounded-full" />
                            <div class="flex items-start justify-between w-full">
                                <div class="pl-3 w-full">
                                    <p tabindex="0" class="focus:outline-none text-xl font-medium leading-5 mt-3 text-gray-800">${el.fname.toUpperCase()} ${el.mname.toUpperCase()}, ${el.lname.toUpperCase()}</p>
                                </div>
                                <div role="img" aria-label="bookmark">
                                    <svg  class="focus:outline-none" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5001 4.66667H17.5001C18.1189 4.66667 18.7124 4.9125 19.15 5.35009C19.5876 5.78767 19.8334 6.38117 19.8334 7V23.3333L14.0001 19.8333L8.16675 23.3333V7C8.16675 6.38117 8.41258 5.78767 8.85017 5.35009C9.28775 4.9125 9.88124 4.66667 10.5001 4.66667Z" stroke="#2C3E50" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                            <table class="table table-bordered text-center text-lg">
                                <tr>
                                    <th>Log Type</th>
                                    <th>Logs Date & Time</th>
                                </tr>
                                <tr>
                                    <td>
                                        ${(el.log_type <= 1) 
                                            ? `
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-blue-400 leading-tight">
                                                <span aria-hidden
                                                    class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">In</span>
                                            </span>
                                            `
                                            : `
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden
                                                    class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Out</span>
                                            </span>`
                                        }
                                    </td>
                                    <td>
                                        <div class="text-red-400 text-xl">${date}</div> 
                                        <div class="text-blue-400 text-lg">${time}</div>
                                    </td>
                                </tr>
                            </table>
                            <div tabindex="0" class="focus:outline-none flex">
                            </div>
                        </div>
                    </div>
                `;
            }); 
            
        } else {
            row = empVal
        }
        document.querySelector("#listTeacherLogs").innerHTML = row;
    };
}

let checkListObj = new ViewTeacherLogs();
checkListObj.SearchTeacher();
checkListObj.fetchViewTeacherLogs();
checkListObj.totalViewTeacherLogs();