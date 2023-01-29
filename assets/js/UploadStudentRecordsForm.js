function UploadRecordsStudent() {

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

    this.excelParserStudent = () => {
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
                        let closeModal = document.querySelector('#studentUploadCsvModal');
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
            let inc = 1;
            let output= ``;
            results.forEach(item => {

            if(item.Student_No     == null 
            || item.FirstName      == null
            || item.MiddleName     == null
            || item.LastName       == null
            || item.Date_of_Birt   == null
            || item.Gender         == null
            || item.Address        == null
            || item.Email          == null
            || item.Contact_Number == null
            ) {
                    this.msgUploadFile('Empty one or more Fields!', 'warning');
                    let elem = document.querySelector('#progressbar');
                    let closeModal = document.querySelector('#uploadStudentGradesModal');
                    let reset = document.querySelector('#excelParser');
                    let count = document.querySelector('#percent');
                    reset.value = null;
                    count.innerHTML = 0 + "%";
                    elem.style.width = 3 + "%";
                    closeModal.click();
                } else {

                    output += `
                        <tr>
                            <td class="px-5 py-5 text-md"><input class="w-5 h-5" type="checkbox" data='${JSON.stringify(item)}'></td>
                            <td class="px-5 py-5 text-md">${++inc}</td>
                            <td class="px-5 py-5 text-md">
                                <div class="relative mx-auto w-20 h-20 rounded-full border-gray-300 border-2">
                                    <img class="w-full h-full rounded-full" src="../assets/images/account.png" alt="avatar" />
                                </div>
                            </td>
                            <td class="px-5 py-5 text-md">${item.Student_No}</td>
                            <td class="px-5 py-5 text-md">
                                ${item.FirstName}
                                ${item.MiddleName},
                                ${item.LastName}
                            </td>
                            <td class="px-5 py-5 text-md">${item.Date_of_Birt}</td>
                            <td class="px-5 py-5 text-md">${item.Gender}</td>
                            <td class="px-5 py-5 text-md">${item.Address}</td>
                            <td class="px-5 py-5 text-md">${item.Email}</td>
                            <td class="px-5 py-5 text-md">${item.Contact_Number}</td>
                        <tr>
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

    this.saveStudentRecords = () => {
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
        
                    let response = await fetch(`../index.php?action=student`, {
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

let stdUploadObj = new UploadRecordsStudent();
stdUploadObj.excelParserStudent();
stdUploadObj.checkAllListUpload();
stdUploadObj.saveStudentRecords();