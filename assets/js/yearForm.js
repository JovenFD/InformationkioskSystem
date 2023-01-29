function Year() {

    this.msgYear = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this. dateFormatYear =(input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }
    
    this.fetchYear = async() => {
        const response = await fetch("../index.php?action=year&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyYear(message);
        } else {
            this.msgYear(message, 'error'); 
        }
    }

    this.searchYear = () => {
        searchyr.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=year`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyYear(message);
                } else {
                    this.msgYear(message, 'error'); 
                }
            } else {
                this.fetchYear();
            }
        };

        searchyrUnact.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=year`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactYear(message);
                } else {
                    this.msgYear(message, 'error'); 
                }
            } else {
                this.fetchYearUnact();
            }
        };
    }

    this.addfromYear = () => {
        yearAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#year-btn");
            let resetForm = document.querySelector("#yearAddForm");
            let closeModaL = document.querySelector("#yearAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=year', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(yearAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchYear();
                    this.totalPagesYear();
                    this.msgYear(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgYear(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllYear = () => {
        yrcheckAll.onclick = async(e) => {
            let items = document.getElementsByName('yr_chk[]');
            if (yrcheckAll.checked == true){
                for(let i=0; i<items.length; i++){
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++){
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }

        yrUnactcheckAll.onclick = async(e) => {
            let items = document.getElementsByName('yrunact_chk[]');
            if (yrUnactcheckAll.checked == true){
                for(let i=0; i<items.length; i++){
                    if(items[i].type=='checkbox')
                        items[i].checked=true;
                }
            } else {
                for(let i=0; i<items.length; i++){
                    if(items[i].type =='checkbox')
                        items[i].checked=false;
                }
            }
        }
    }

    this.removeYear = () => {
        yearDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to set UnActive this School Year?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=year`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(yearDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgYear(message, 'success');
                        this.fetchYear();   
                        this.totalPagesYear();
                        this.fetchYearUnact();
                    } else {
                        this.msgYear(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };   

        yearUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to set Active this School Year?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=year`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(yearUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgYear(message, 'success');
                        this.fetchYear();   
                        this.totalPagesYear();
                        this.fetchYearUnact();
                    } else {
                        this.msgYear(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
    }

    this.printAllYearData = () => {
        btnPrintSchoolYearData.onclick = async() => {
            swal({
                title: "Are you sure you do want to print all this School Year records?",
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

                    const response = await fetch(`../index.php?action=year&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status != 'error') {
                        let mywindow = window.open(
                            `print_year_data.php`, 
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
                        this.msgYear(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitPagesYear = () => {
        limityear.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=year&yrsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyYear(message);
                this.totalPagesYear();
            } else {
                this.msgYear(message, 'success'); 
            }
        };
    };

    this.totalPagesYear = async() => {
        const response  = await fetch(`../index.php?action=year&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevYear.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationYear(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            nextYear.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationYear(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(yrObj.paginationYear(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#yr-btn-pages').innerHTML = output;

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
            this.msgYear(message, 'error'); 
        }
    };

    this.paginationYear = async(pagenum) => {
        const response = await fetch(`../index.php?action=year&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyYear(message);
        } else {
            this.msgYear(message, 'error'); 
        }
    }

    this.addValueUpdateYear= async(yrid) => {
        let formData = new FormData();
        formData.append('yrid', yrid);

        let response = await fetch(`../index.php?action=year`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#yearid').value = message.id;
            document.querySelector('#newyearForm').value = message.schoolyear;
        } else {
            this.msgYear(message, 'error'); 
        }
    } 

    this.updatefromYear = () => {
        yearUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newyear-btn");
            let resetForm = document.querySelector("#yearUpdateForm");
            let closeModaL = document.querySelector("#yearUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=year', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(yearUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchYear();
                    this.totalPagesYear();
                    this.msgYear(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgYear(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyYear = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="4" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="yr_chk[]" value="${el.id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.schoolyear}</td>
                    <td class="px-5 py-5">
                        <button onclick="yrObj.addValueUpdateYear(${el.id})" type="button" data-toggle="modal" data-target="#yearUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button> 
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyyear").innerHTML = row;
    };

    this.fetchYearUnact = async() => {
        const response = await fetch("../index.php?action=year&viewUnact", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactYear(message);
        } else {
            this.msgYear(message, 'error'); 
        }
    }

    this.tableBodyUnactYear = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="3" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5 text-md">
                        <input class="w-5 h-5" type="checkbox" name="yrunact_chk[]" value="${el.id}">
                    </td>
                    <td class="px-5 py-5 text-md">${++inc}</td>
                    <td class="px-5 py-5 text-md">${el.schoolyear}</td>
                </tr>
                `;
            }); 
        } else {
            row = empVal;
        }
        document.querySelector("#tbodyUnactYear").innerHTML = row;
    };
}

let yrObj = new Year();
yrObj.fetchYear();
yrObj.searchYear();
yrObj.addfromYear();
yrObj.removeYear();
yrObj.limitPagesYear();
yrObj.totalPagesYear();
yrObj.updatefromYear();
yrObj.printAllYearData();
yrObj.checkAllYear();
yrObj.fetchYearUnact();