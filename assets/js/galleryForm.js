function Gallery() {

    this.msgGallery = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 1000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchGallery = async() => {
        const response = await fetch("../index.php?action=uploadSchoolImages&galleryView", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {

            this.tableBodyGallery(message);

        } else {
            this.msgGallery(message, 'error'); 
        }
    }

    this.addFormGallery = () => {

        gallerycameras.onclick = (e) => {
            document.querySelector('#galleryfileChooser').click();
        }
        
        galleryfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#galleryavatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        galleryAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#gallery-btn");
            let resetForm = document.querySelector("#galleryAddForm");
            let closeModaL = document.querySelector("#galleryAddModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=uploadSchoolImages', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(galleryAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchGallery();
                    this.totalPagesGallery();
                    this.msgGallery(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgGallery(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllGallery = () => {
        imgCheckAll.onclick = async(e) => {
            let items = document.getElementsByName('gallery_chk[]');
            if (imgCheckAll.checked == true){
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

    this.removeGallery = () => {
        galleryForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to remove this Picture?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=uploadSchoolImages`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(galleryForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgGallery(message, 'success');
                        this.fetchGallery();   
                        this.totalPagesGallery();
                    } else {
                        this.msgGallery(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
    } 

    this.limitGallery = () => {
        limitgallery.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=uploadSchoolImages&gallerysort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyGallery(message);
                this.totalPagesGallery();
            } else {
                this.msgGallery(message, 'success'); 
            }
        };
    };

    this.totalPagesGallery = async() => {
        const response  = await fetch(`../index.php?action=uploadSchoolImages&totalpage`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevgallery.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationGallery(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            nextgallery.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationGallery(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(imgObj.paginationGallery(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#gallery-btn-pages').innerHTML = output;

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
            this.msgGallery(message, 'error'); 
        }
    };

    this.paginationGallery = async(pagenum) => {
        const response = await fetch(`../index.php?action=uploadSchoolImages&pagenumGallery=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyGallery(message);
        } else {
            this.msgGallery(message, 'error'); 
        }
    }

    this.tableBodyGallery = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="5" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                let filename = el.filename.slice(10, el.filename.length);
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="gallery_chk[]" value="${el.galllery_id}">
                    </td>
                    <td class="px-5 py-5">${++inc}</td>
                    <td class="px-5 py-5">${filename}</td>
                    <td class="px-5 py-5">
                        <div class="relative mx-auto w-42 h-42 rounded-xl border-gray-300 border-2">
                            <img class="w-full h-full rounded-xl" src=".${el.filename}" alt="sliderImg" />
                        </div>
                    </td>
                    <td class="px-5 py-5">
                        <button onclick="imgObj.addUpateValueGallery(
                            '${el.filename}',
                            '${el.galllery_id}',
                            )" type="button" data-toggle="modal" data-target="#galleryUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                            <i class="fa fa-edit text-2xl"></i>
                        </button> 
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal
        }
        document.querySelector("#tbodygallery").innerHTML = row;
    };

    this.addUpateValueGallery = (path, id) => {
        document.querySelector('#NewGalleryavatar').src = `.${path}`;
        document.querySelector('#galleryId').value = id;
        document.querySelector('#currentGalleryVal').value = `${path}`;
    }

    this.updateFormGallery = () => {
        NewGalleryCameras.onclick = (e) => {
            document.querySelector('#NewGalleryfileChooser').click();
        }
        
        NewGalleryfileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#NewGalleryavatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        newGalleryUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#newGallery-btn");
            let resetForm = document.querySelector("#newGalleryUpdateForm");
            let closeModaL = document.querySelector("#galleryUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=uploadSchoolImages', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(newGalleryUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchGallery();
                    this.totalPagesGallery();
                    this.msgGallery(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgGallery(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  
}
let imgObj = new Gallery();
imgObj.fetchGallery();
imgObj.addFormGallery();
imgObj.checkAllGallery();
imgObj.removeGallery();
imgObj.limitGallery();
imgObj.totalPagesGallery();
imgObj.updateFormGallery();