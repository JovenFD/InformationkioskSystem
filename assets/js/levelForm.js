function Level() {

    this.msgLevel = async(msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }
    
    this.fetchLevel = async() => {
        const response = await fetch("../index.php?action=level&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyLevel(message);
        } else {
            this.msgLevel(message, 'error'); 
        }
    }

    this.searchLevel = () => {
        searchlvl.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=level`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyLevel(message);
                } else {
                    this.msgLevel(message, 'error'); 
                }
            } else {
                this.fetchLevel();
            }
        };

        searchlvlUnact.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataUnact', data);
    
                let response = await fetch(`../index.php?action=level`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyUnactLevel(message);
                } else {
                    this.msgLevel(message, 'error'); 
                }
            } else {
                this.fetchUnactLevel();
            }
        };
    }

    this.addformLevel = () => {
        lvlAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#lvl-btn");
            let resetForm = document.querySelector("#lvlAddForm");
            let closeModaL = document.querySelector("#levelAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=level', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(lvlAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchLevel();
                    this.totalPagesLevel();;
                    this.msgLevel(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgLevel(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllLevel = () => {
        lvlcheckAll.onclick = async() => {
            let items = document.getElementsByName('lvl_chk[]');
            if (lvlcheckAll.checked == true){
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

        lvlUnactcheckAll.onclick = async() => {
            let items = document.getElementsByName('lvlUnact_chk[]');
            if (lvlUnactcheckAll.checked == true){
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

    this.removeLevel = () => {
        levelDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set UnActive this Year Level?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=level`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(levelDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgLevel(message, 'success');
                        this.fetchLevel();   
                        this.totalPagesLevel();
                        this.fetchUnactLevel();
                    } else {
                        this.msgLevel(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
        
        levelUnactForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do you want to set Active this Year Level?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=level`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(levelUnactForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgLevel(message, 'success');
                        this.fetchLevel();   
                        this.totalPagesLevel();
                        this.fetchUnactLevel();
                    } else {
                        this.msgLevel(message, 'error');
                    }
                    
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
    }

    this.printAllLevelData = () => {
        btnPrintAllLevelData.onclick = async(e) => {
            swal({
                title: "Are you sure you want to print all this Year Level records?",
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

                    const response = await fetch(`../index.php?action=level&print`, {
                        credentials: "same-origin",
                        method: "GET",
                    });

                    let {status} = await response.json();

                    if(status == 'success') {
                        let mywindow = window.open(
                            `print_level_data.php`, 
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
                        this.msgLevel(message, 'error');
                    }
                } else {
                    swal("Cancel printing!");
                }
            });
        }
    }

    this.limitPagesLevel = () => {
        limitlevel.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=level&lvlsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyLevel(message);
                this.totalPagesLevel();
            } else {
                this.msgLevel(message, 'error'); 
            }
        }
    };

    this.totalPagesLevel = async() => {
        const response  = await fetch(`../index.php?action=level&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevLevel.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationLevel(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber+1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };
        
            nextLevel.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationLevel(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(lvlObj.paginationLevel(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#lvl-btn-pages').innerHTML = output;

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
            this.msgLevel(message, 'error'); 
        }
    };

    this.paginationLevel = async(pagenum) => {
        const response = await fetch(`../index.php?action=level&pagenum=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyLevel(message);
            this.totalPagesLevel();
        } else {
            this.msgLevel(message, 'error'); 
        }
    }

    this.addValueUpdateLevel = async(lvlid) => {
        let formData = new FormData();
        formData.append('lvlid', lvlid);

        let response = await fetch(`../index.php?action=level`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#lvlid').value   = message.level_id;
            document.querySelector('#lvlyear').value = message.	grade_level;
            document.querySelector('#lvldesc').value = message.discription;
        } else {
            this.msgLevel(message, 'error'); 
        }
    }
    
    this.updatefromLevel = () => {
        lvlUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newlvl-btn");
            let resetForm = document.querySelector("#lvlUpdateForm");
            let closeModaL = document.querySelector("#levelUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=level', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(lvlUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchLevel();
                    this.totalPagesLevel();
                    this.msgLevel(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgLevel(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyLevel = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="lvl_chk[]" value="${el.level_id }">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${el.grade_level}</td>
                    <td class="px-5 py-5">${el.discription}</td>
                    <td class="px-5 py-5">
                        <button onclick="lvlObj.addValueUpdateLevel(${el.level_id})" type="button" data-toggle="modal" data-target="#levelUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-pen text-2xl"></i>
                        </button>
                    </td>
                </tr>`;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodylevel").innerHTML = row;
    };

    this.fetchUnactLevel = async() => {
        const response = await fetch("../index.php?action=level&viewUnact", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyUnactLevel(message);
        } else {
            this.msgLevel(message, 'error'); 
        }
    }

    this.tableBodyUnactLevel = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="4" class="font-5xl text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                row += `
                <tr>
                    <td class="px-5 py-5 text-md">
                        <input class="w-5 h-5" type="checkbox" name="lvlUnact_chk[]" value="${el.level_id }">
                    </td>
                    <td class="px-5 py-5 text-md">${++inc}</td>
                    <td class="px-5 py-5 text-md">${el.grade_level}</td>
                    <td class="px-5 py-5 text-md">${el.discription}</td>
                </tr>`;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyUnactLevel").innerHTML = row;
    };
}

let lvlObj = new Level();
lvlObj.fetchLevel();
lvlObj.searchLevel();
lvlObj.addformLevel();
lvlObj.removeLevel();
lvlObj.limitPagesLevel();
lvlObj.totalPagesLevel();
lvlObj.updatefromLevel();
lvlObj.printAllLevelData();
lvlObj.checkAllLevel();
lvlObj.fetchUnactLevel();
