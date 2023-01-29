function LogsTeacher() {

    this.msgLogs = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.dateFormatLogs = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.fetchLogs = async() => {
        const response = await fetch("../index.php?action=teacherLogs&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyLogs(message);
        } else {
            this.msgLogs(message, 'error'); 
        }
    };

    this.searchLogs = () => {
        searchTeacherLogsData.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let LogSearch  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('LogSearch', LogSearch);
    
                let response = await fetch(`../index.php?action=teacherLogs`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyLogs(message);
                } else {
                    this.msgLogs(message, 'error'); 
                }
                
            } else {
                this.fetchLogs();
            }
        };
    }

    this.limitLogPages = () => {
        limitteacherlogsnum.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacherLogs&logsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyLogs(message);
                this.totalPagesLogs();
            } else {
                this.msgLogs(message, 'error'); 
            }
        };
    };

    this.totalPagesLogs= async() => {
        const response = await fetch(`../index.php?action=teacherLogs&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;

            let pagenumber = 1;
            logsTeacherPrev.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationLogs(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnListTeacher${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };
        
            logsTeacherNext.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationLogs(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnListTeacher${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `
                    <div id="btnListTeacher${i}" onclick="(logTeacherObj.paginationLogs(${i}))" class="child p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }
            
            document.querySelector('#logs-btn-teacher-pages').innerHTML = output;

            let elements = document.getElementsByClassName("child");

            for(let i = 0; i < elements.length; i++) {   
                elements[i].addEventListener('click', function(e) {
                    e.preventDefault();
                      
                    let el = elements[0];
                    
                    while(el) {
                        if(el.tagName == "DIV"){
                            //remove class
                            el.classList.remove("bg-blue-200");
                        }
                        // pass to the new sibling
                        el = el.nextSibling;
                    }
                  this.classList.add("bg-blue-200");  
                });
            }

        } else {
            this.msgLogs(message, 'error'); 
        }
    };

    this.paginationLogs = async(pagenum) => {
        const response = await fetch(`../index.php?action=teacherLogs&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') {   
            this.tableBodyLogs(message);
        } else {
            this.msgLogs(message, 'error'); 
        }
    }

    this.trackDateLogs = () => {
        this.activeDropown(
            'dateteacherfrom',
            "rgb(60, 179, 113)",
            false
        );

        dateteacherfrom.onchange = async(e) => {
            this.activeDropown(
                'dateteacherto',
                "rgb(60, 179, 113)",
                false
            );

            this.activeDropown(
                'dateteacherfrom',
                "",
                false
            );
        }

        dateteacherto.onchange = async(e) => {
            let datefrom = document.querySelector('#dateteacherfrom').value;
            let dateteacherto  = e.currentTarget.value;

            if(datefrom.length > 0) {
                let data = {
                    datefrom: datefrom,
                    dateto: dateteacherto
                };
                let formData = new FormData();

                formData.append('data', JSON.stringify(data));
    
                let response = await fetch(`../index.php?action=teacherLogs`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyLogs(message);
                } else {
                    this.msgLogs(message, 'error'); 
                }
            } else {
                this.fetchLogs();
            }
        };
    }

    this.activeDropown = async(type, bcolor, status) => {
        let val = document.querySelector(`#${type}`);

        val.style.borderColor = bcolor;
        val.disabled = status;
    }

    this.printAllLogsData = () => {
        btnPrintStudentLogsData.onclick = async(e) => {
            swal({
                title: "Are you sure you want to print all this School Logs records?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let w = 1500;
                    let h = 700;
                    let left = (screen.width/2 - w/2);
                    let top  = (screen.height/2 - h/2);

                    const response = await fetch(`../index.php?action=teacherLogs&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status == 'success') {  
                        let mywindow = window.open(
                            `print_logs_teacher_data.php`, 
                            `Print`, 
                            `height=${h},
                            width=${w},
                            left=${left}, 
                            top=${top}`
                        );

                        setTimeout(()=>{
                            mywindow.document.close();
                            mywindow.focus();
                            mywindow.print();
                        },3000);
                
                    } else {
                        this.msgLogs(message, 'error');
                    }
                    
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.tableBodyLogs = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="6" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                let date = new Date(el.created_date).toDateString();
                let time = new Date(el.created_date).toLocaleTimeString();
                row += `
                <tr>
                    <td class="px-5 py-5 text-sm">  
                        ${++inc}
                    </td>
                    <td class="px-5 py-4">
                        <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                            <img class="w-full h-full rounded-full" src="${el.avatar}" alt="avatar" />
                        </div>
                    </td>
                    <td class="px-5 py-5 text-sm">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5 text-sm">
                        ${el.type}
                    </td>
                    <td class="px-5 py-5 text-sm">
                            ${(el.log_type <= 1) 
                            ? `
                            <span
                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
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
                    <td class="px-5 py-5 text-sm">
                        <div class="text-red-400 text-xl">${date}</div> 
                        <div class="text-blue-400 text-lg">${time}</div>
                    </td>
                </tr>
                `;
            });
            this.activeDropown(
                'datefrom',
                "rgb(60, 179, 113)",
                false
            );

            this.activeDropown(
                'dateto',
                "",
                true
            ); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyteacherlogs").innerHTML = row;
    };
}

let logTeacherObj = new LogsTeacher();
logTeacherObj.fetchLogs();
logTeacherObj.limitLogPages()
logTeacherObj.totalPagesLogs();
logTeacherObj.trackDateLogs();
logTeacherObj.printAllLogsData();
logTeacherObj.searchLogs();
