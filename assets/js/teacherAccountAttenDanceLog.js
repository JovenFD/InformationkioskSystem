function AttendaceLog() {

    this.msgAttendanceLog = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchAttendanceLogs = async() => {
        const response = await fetch("../index.php?action=teacherAccount&viewLog", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyAttendaceLogs(message);
        } else {
            this.msgAttendanceLog(message, 'error'); 
        }
    };

    this.trackDateAttendanceLogs = () => {

        this.activeDropown(
            'datefromattlogs',
            "rgb(60, 179, 113)",
            false
        );

        datefromattlogs.onchange = async(e) => {
            this.activeDropown(
                'datetoattlogs',
                "rgb(60, 179, 113)",
                false
            );

            this.activeDropown(
                'datefromattlogs',
                "",
                false
            );
        }

        datetoattlogs.onchange = async(e) => {
            let datefrom = document.querySelector('#datefromattlogs').value;
            let dateto  = e.currentTarget.value;

            if(datefrom.length > 0) {
                let data = {
                    datefrom: datefrom,
                    dateto: dateto
                };
                let formData = new FormData();

                formData.append('dataattlog', JSON.stringify(data));
    
                let response = await fetch(`../index.php?action=teacherAccount`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyAttendaceLogs(message);
                } else {
                    this.msgAttendanceLog(message, 'error'); 
                }
            } else {
                this.fetchAttendanceLogs();
            }
        };
    }

    this.activeDropown = async(type, bcolor, status) => {
        let val  = document.querySelector(`#${type}`);

        val.style.borderColor = bcolor;
        val.disabled = status;
    }

    this.printAllLogsAttendanceData = () => {
        let w = 1500;
        let h = 700;
        let left = (screen.width/2 - w/2);
        let top  = (screen.height/2 - h/2);

        btnPrintLogs.onclick = async(e) => {
            swal({
                title: "Are you sure you do want to print all Attendance Log Records?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    const response = await fetch(`../index.php?action=teacherAccount&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status == 'success') {  
                        let mywindow = window.open(
                            `print_attendancelogs_data.php`, 
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
                        this.msgAttendanceLog(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitPagesAttendaceLags = () => {
        limitattlogs.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=teacherAccount&attlogssort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyAttendaceLogs(message);
                this.totalPagesAttendanceLogs(message);
            } else {
                this.msgAttendanceLog(message, 'success'); 
            }
        };
    };

    this.totalPagesAttendanceLogs = async() => {
        const response  = await fetch(`../index.php?action=teacherAccount&totalpageattlogs`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevAttlogs.onclick = async(e) => {
                if(pagenumber >= 1) {
                    this.paginationAttendanceLogs(pagenumber -= 1);
                } 
            };
        
            nextAttlogs.onclick = async(e) => {
                if(pagenumber < total_pages) {
                    this.paginationAttendanceLogs(pagenumber += 1);
                }
            };
            
            for (let i = 1; i < total_pages+1; i++) {
                output += `<div onclick="(attLogObj.paginationAttendanceLogs(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#attlogs-btn-pages').innerHTML = output;

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
            this.msgAttendanceLog(message, 'error'); 
        }
    };

    this.paginationAttendanceLogs = async(pagenum) => {
        const response = await fetch(`../index.php?action=teacherAccount&pagenumattlogs=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyAttendaceLogs(message);
        } else {
            this.msgAttendanceLog(message, 'error'); 
        }
    }

    this.tableBodyAttendaceLogs = (data) => {
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
                'datefromattlogs',
                "rgb(60, 179, 113)",
                false
            );

            this.activeDropown(
                'datetoattlogs',
                "",
                true
            );
        } else {
            row = empVal
        }
        document.querySelector("#tbodyattendacelogs").innerHTML = row;
    };
}

let attLogObj = new AttendaceLog();
attLogObj.fetchAttendanceLogs();
attLogObj.trackDateAttendanceLogs();
attLogObj.limitPagesAttendaceLags();
attLogObj.totalPagesAttendanceLogs();
attLogObj.printAllLogsAttendanceData();