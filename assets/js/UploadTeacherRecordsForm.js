function UploadRecordsTeacher() {

    this.msgUploadFile = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.excelParserTeacher = () => {
        excelParser.onchange = async(e) => {
            let i = 0;

            if (i == 0) {
                i = 1;
                let elem = document.querySelector('#progressUploadbar');
                let count = document.querySelector('#percentUpload');
                let width = 1;
                let id = setInterval(frame, 10);
                function frame () {
                  if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                  } else {
                    width++;
                    count.innerHTML  = width + "%";
                    elem.style.width = width + "%";
                  }
                }
            }

            setTimeout(() => {
                this.showUploadFile(e);
            }, 2000);
        }
    }

    this.showUploadFile = async(e) => {
        if (e.target.files && e.target.files[0]) {
            
            let results = await new Promise((resolve, reject) => {
                Papa.parse(e.target.files[0], {
                    header: true, // makes the value of first row as the column name or key
                    skipEmptyLines: true,
                    dynamicTyping: true, // converts numerical strings to number
                    complete: function(results) {
                        resolve(results.data);
                        let elem = document.querySelector('#progressUploadbar');
                        let closeModal = document.querySelector('#teacherUploadCsvModal');
                        let reset = document.querySelector('#excelParser');
                        let count = document.querySelector('#percentUpload');
                        reset.value = null;
                        count.innerHTML = 0 + "%";
                        elem.style.width = 3 + "%";
                        closeModal.click();
                    }
                });
            });
    
            let tbody = document.querySelector('#importTable>tbody');
            results.forEach(item => {
            let output = ``;
            let inc = 1;

            if( item.FirstName     == null
            || item.MiddleName     == null
            || item.LastName       == null
            || item.Date_of_Birt   == null
            || item.Gender         == null
            || item.Address        == null
            || item.Email          == null
            || item.Contact_Number == null
            || item.Password       == null
            ) {
                    this.msgUploadFile('Empty one or more Fields!', 'warning');
                    let elem = document.querySelector('#progressbar');
                    let closeModal = document.querySelector('#teacherUploadCsvModal');
                    let reset = document.querySelector('#excelParser');
                    let count = document.querySelector('#percent');
                    reset.value = null;
                    count.innerHTML = 0 + "%";
                    elem.style.width = 3 + "%";
                    closeModal.click();
                } else {

                    output += `
                        <td class="px-5 py-5"><input class="w-5 h-5" type="checkbox" data='${JSON.stringify(item)}'></td>
                        <td class="px-5 py-5">${++inc}</td>
                        <td class="px-5 py-5">
                            <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                                <img class="w-full h-full rounded-full" src="../assets/images/account.png" alt="avatar" />
                            </div>
                        </td>
                        <td class="px-5 py-5">
                            ${item.FirstName}
                            ${item.MiddleName},
                            ${item.LastName}
                        </td>
                        <td class="px-5 py-5">${item.Date_of_Birt}</td>
                        <td class="px-5 py-5">${item.Gender}</td>
                        <td class="px-5 py-5">${item.Address}</td>
                        <td class="px-5 py-5">${item.Email}</td>
                        <td class="px-5 py-5">${item.Contact_Number}</td>
                    `;
                    tbody.innerHTML = output;
                }
            });
        }
    };

    this.checkAllListUpload = () => {
        checkBox.onclick = async(e) => {
            if (checkBox.checked == true){
                let checkBoxes = document.querySelectorAll('#importTable>tbody :not(input:checked)');
                checkBoxes.forEach(checkBox => checkBox.click());
            } else {
                let checkBoxes = document.querySelectorAll('#importTable>tbody input:checked');

                checkBoxes.forEach(checkBox => checkBox.click());
            }
        }
    }

    this.saveTeacherRecords = () => {
        saveAllChecked.onclick = async(e) => {
            let allChecked = document.querySelectorAll('#importTable>tbody input:checked');

            if (allChecked.length) {
                for (let i = 0; i < allChecked.length; i++) {
                    let checkBox = allChecked[i];
                    let data = JSON.parse(checkBox.getAttribute('data'));
                    let tr = checkBox.parentNode.parentNode;
                    let formData = new FormData();
                    Object.keys(data).forEach(key => {
                        formData.append(key, data[key]);
                    });
        
                    let response = await fetch(`../index.php?action=teacher`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: formData
                    });
                    let { message, status } = await response.json();
        
                    if (status == 'success') {
                        this.msgUploadFile(message, 'success');
                    } else {
                        this.msgUploadFile(message, 'error');
                    }
                }
            } else {
                this.msgUploadFile('Empty Fields', 'warning');
            }
        }
    }
}

let teacherCsvFileObj = new UploadRecordsTeacher();
teacherCsvFileObj.excelParserTeacher();
teacherCsvFileObj.checkAllListUpload();
teacherCsvFileObj.saveTeacherRecords();