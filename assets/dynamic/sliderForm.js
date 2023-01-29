function sliderForm() {
    
    this.msgSlider = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchSlider = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&viewSlider", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodySlider(message);
        } else {
            this.msgSlider(message, 'error'); 
        }
    }

    this.addFormSlider = () => {

        slidercameras.onclick = (e) => {
            document.querySelector('#sliderfileChooser').click();
        }
        
        sliderfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#slideravatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        sliderAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#slider-btn");
            let resetForm = document.querySelector("#sliderAddForm");
            let resetavatar = document.querySelector("#slideravatar");
            let closeModaL = document.querySelector("#sliderAddModal");
            let defaultavatar = '../assets/slideShowImg/defaultImg.jpg';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(sliderAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchSlider();
                    this.totalPagesSlider();
                    this.msgSlider(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgSlider(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.limitSlider = () => {
        limitSlider.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=dynamicComponent&sydrsort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodySlider(message);
                this.totalPagesSlider();
            } else {
                this.msgSlider(message, 'success'); 
            }
        };
    };

    this.totalPagesSlider = async() => {
        const response  = await fetch(`../index.php?action=dynamicComponent&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevslider.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationSlider(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            nextslider.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationSlider(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(sliderObj.paginationSlider(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#slider-btn-pages').innerHTML = output;

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
            this.msgNews(message, 'error'); 
        }
    };

    this.paginationSlider = async(pagenum) => {
        const response = await fetch(`../index.php?action=dynamicComponent&pagenumSlider=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodySlider(message);
        } else {
            this.msgSlider(message, 'error'); 
        }
    }

    this.checkAllSlider = () => {
        sldrcheckAll.onclick = async(e) => {
            let items = document.getElementsByName('sldr_chk[]');
            if (sldrcheckAll.checked == true){
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

    this.removeSlider = () => {
        sliderRemoveForms.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to remove this SlideShow Picture?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=dynamicComponent`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(sliderRemoveForms)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgSlider(message, 'success');
                        this.fetchSlider();   
                        this.totalPagesSlider();
                    } else {
                        this.msgSlider(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
    } 

    this.tableBodySlider = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                let filename = el.slidehow_img.slice(10, el.slidehow_img.length);
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="sldr_chk[]" value="${el.slidehow_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${filename}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-42 h-42 rounded-xl border-gray-300 border-2">
                            <img class="w-full h-full rounded-xl" src=".${el.slidehow_img}" alt="sliderImg" />
                        </div>
                    </td>
                    <td class="px-5 py-5">
                        <button onclick="sliderObj.addUpateValueSlider(
                            '${el.slidehow_img}',
                            '${el.slidehow_id}',
                            )" type="button" data-toggle="modal" data-target="#sliderUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-edit text-2xl"></i>
                        </button> 
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodyslider").innerHTML = row;
    };

    this.addUpateValueSlider = (img, id) => {
        document.querySelector('#newslideravatar').src = `.${img}`;
        document.querySelector('#idSlider').value = id;
        document.querySelector('#currentVal').value = `${img}`;
    } 

    this.updateFormSlider  = () => {
        newslidercameras.onclick = (e) => {
            document.querySelector('#newsliderfileChooser').click();
        }
        
        newsliderfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#newslideravatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        sliderNewUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newslider-btn");
            let resetForm = document.querySelector("#sliderNewUpdateForm");
            let closeModaL = document.querySelector("#sliderUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(sliderNewUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchSlider();
                    this.totalPagesSlider();
                    this.msgSlider(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgSlider(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  
}

let sliderObj = new sliderForm();
sliderObj.fetchSlider();
sliderObj.limitSlider();
sliderObj.checkAllSlider();
sliderObj.removeSlider();
sliderObj.addFormSlider();
sliderObj.totalPagesSlider();
sliderObj.updateFormSlider();