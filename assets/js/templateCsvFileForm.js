function TemplateCsvFile() {

    this.msgsCsvFile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.modalListOptionSchoolYear = async() => {
        let select  = document.querySelector('#listyear');
        let defualtop = `<option value=''>Select School Year</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=year&view", {
            credentials: "same-origin",
            method: "GET",
        }); 

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.id}">${el.schoolyear } 
                        </option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML = defualtop+output;
            select.style.borderColor = "rgb(60, 179, 113)";
        } else {
            this.msgsCsvFile(message, 'error'); 
        }

        select.addEventListener('input', (e) => {
            let val = e.currentTarget.value;
            let subject = document.querySelector('#listsubject');
            select.style.borderColor = "rgb(60, 179, 113)";

            if(val.length > 0 || val != '') {
                select.style.borderColor = "";
                subject.style.borderColor = "rgb(60, 179, 113)";
                subject.disabled=false; 
                this.modalListOptionSubject();
            } else {
                subject.style.borderColor = "rgba(255, 99, 71, 0.6)";
                subject.disabled=true; 
            }
        });
    }

    this.modalListOptionSubject = async() => {
        let select   = document.querySelector('#listsubject');
        let defualtop = `<option value=''>Select Subject</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=subject&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.subject_id}">
                            ${el.subject_name} - ${el.discription_subject}
                        </option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Subject</option>`;
             } 
            select.innerHTML = defualtop+output;
        } else {
            this.msgsCsvFile(message, 'error'); 
        }

        select.addEventListener('input', (e) => {
            let val = e.currentTarget.value;
            let teacher = document.querySelector('#listteacher');
            select.style.borderColor = "rgb(60, 179, 113)";

            if(val.length > 0 || val != '') {
                select.style.borderColor = "";
                teacher.style.borderColor = "rgb(60, 179, 113)";
                teacher.disabled=false; 
                this.modalListOptionTeacher();
            } else {
                teacher.style.borderColor = "rgba(255, 99, 71, 0.6)";
                teacher.disabled=true; 
            }
        });
    }

    this.modalListOptionTeacher = async() => {
        let select   = document.querySelector('#listteacher');
        let defualtop = `<option value=''>Select Teacher</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=teacher&view", {
            credentials: "same-origin",
            method: "GET",
        }); 

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.teacher_id}">
                            ${el.fname} 
                            ${el.mname.charAt(0).toUpperCase()}, 
                            ${el.lname}
                        </option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML = defualtop+output;
        } else {
            this.msgsCsvFile(message, 'error'); 
        }

        select.addEventListener('input', (e) => {
            let val = e.currentTarget.value;
            let classes = document.querySelector('#listclass');
            select.style.borderColor = "rgb(60, 179, 113)";

            if(val.length > 0 || val != '') {
                select.style.borderColor = "";
                classes.style.borderColor = "rgb(60, 179, 113)";
                classes.disabled=false; 
                this.modalListOptionClass();
            } else {
                classes.style.borderColor = "rgba(255, 99, 71, 0.6)";
                classes.disabled=true; 
            }
        });
    }

    this.modalListOptionClass = async() => {
        let select   = document.querySelector('#listclass'); 
        let defualtop = `<option value=''>Select Class</option>`;
        let output = ``;
        const response = await fetch("../index.php?action=class&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.class_id}">${el.classname}</option>
                    `;
                });
            } else  {
                    output = `<option value=''>Empty Class</option>`;
             } 
            select.innerHTML   = defualtop+output;
        } else {
            this.msgsCsvFile(message, 'error'); 
        }
        
        select.onchange = async(e) => {
            let year    = document.querySelector('#listyear').value;
            let subject = document.querySelector('#listsubject').value;
            let teacher = document.querySelector('#listteacher').value;
            let classes = e.currentTarget.value;

            if(classes.length > 0 || classes != '') {
                this.setAllValue(
                    year, 
                    subject, 
                    teacher, 
                    classes
                );
            } else {
                this.msgsCsvFile('Empty or more fields....', 'warning'); 
            }
        }
    }

    this.setAllValue = async(year, subject, teacher, classes) => {

        let response = await fetch(`../index.php?action=csvfile&syid=${year}&subid=${subject}&cid=${classes}&tcid=${teacher}`, {
            method: "GET",
        }); 

        let {message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyCsvfile(message);
            this.resetForm();
        } else {
            this.msgsCsvFile(message, 'error');  
        }
    }

    this.resetForm = () => {
        let year  = document.querySelector('#listyear');
        let subject = document.querySelector('#listsubject');
        let teacher = document.querySelector('#listteacher');
        let classes   = document.querySelector('#listclass'); 

        subject.style.borderColor = "";
        teacher.style.borderColor = "";
        classes.style.borderColor = "";
        year.style.borderColor = "rgb(60, 179, 113)";
        subject.disabled=true;
        teacher.disabled=true;  
        classes.disabled=true; 
    }

    this.tableBodyCsvfile = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="8" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {

                row += `
                <tr>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">
                        ${el.fname} 
                        ${el.mname.charAt(0).toUpperCase()}, 
                        ${el.lname}
                    </td>
                    <td class="px-5 py-5"></td>
                    <td class="px-5 py-5"></td>
                    <td class="px-5 py-5"></td>
                    <td class="px-5 py-5"></td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyCsvFile").innerHTML = row;
    };

    this.csvFileDownload = () => {
        btnFilecsv.onclick = async(e) => {
             swal({
            title: "Are you sure you want to download this csv file?",
            icon: "warning",
            buttons: true,
                dangerMode: true,
            })
            .then(async(remove) => {
                if (remove) {

                    const response = await fetch("../index.php?action=csvfile&downloadcsvfile", {
                        credentials: "same-origin",
                        method: "GET",
                    });
            
                    let { heading, message, teacher, status} = await response.json();
            
                    if(status == 'success') {
                        let empVal = `<td colspan="8" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

                        document.querySelector("#tbodyCsvFile").innerHTML = empVal;

                        this.downloadCsvFile(
                            heading,
                            message,
                            teacher
                            );
                    } else {
                        this.msgsCsvFile(message, 'warning'); 
                    }
                    
                } else {
                    swal("Cancel Download!");
                }
            })
        }
    }

    this.downloadCsvFile = (heading, data, teacher) => {
        if(teacher != true) {
            let filename = '';

            teacher.forEach(el => {
                filename = `${el.fname} ${el.mname}, ${el.lname}`;
            }); 
            
            let header = `${heading[0]}, ${heading[1]}, ${heading[2]}, ${heading[3]} \nStudent_Id,Student_Name,First_Quarter,Second_Quarter,Third_Quarter,Fourth_Quarter\n`;
            
            let el = document.createElement('a');
            el.href = 'data:text/csv;charset=utf-8,' + encodeURI( header += data);
            el.target = '_blank';

            let current = new Date();
            let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
            let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
            let dateTime = cDate + ' ' + cTime;
            
            el.download = `(${filename}) `+dateTime+'.csv';
            el.click();
        }
    }

    this.unsetSession = async() => {
        const response = await fetch("../index.php?action=csvfile&unsetsession", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.msgsCsvFile(message, 'success'); 
        } else {
            this.msgsCsvFile(message, 'warning'); 
        }
    }
}

let csvfileOb = new  TemplateCsvFile();
csvfileOb.modalListOptionClass();
csvfileOb.modalListOptionSchoolYear();
csvfileOb.csvFileDownload();