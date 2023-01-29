function News() {

    this.msgNews = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchNews = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&viewNews", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyNews(message);
        } else {
            this.msgNews(message, 'error'); 
        }
    }

    this.tracateText = (str) => {
        return str.slice(0, 20).concat('...');
    } 

    this.searchNews = () => {
        searchNews.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('dataNews', data);
    
                let response = await fetch(`../index.php?action=dynamicComponent`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyNews(message);
                } else {
                    this.msgNews(message, 'error'); 
                }
            } else {
                this.fetchNews();
            }
        };
    }

    this.addFormNews = () => {
        cameraNews.onclick = (e) => {
            document.querySelector('#fileChooserNews').click();
        }
        
        fileChooserNews.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarNews').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        newsAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#news-btn");
            let resetForm = document.querySelector("#newsAddForm");
            let resetavatar = document.querySelector("#avatarNews");
            let closeModaL = document.querySelector("#newsAddModal");
            let defaultavatar = '../assets/slideShowImg/defaultImg.jpg';
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(newsAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchNews();
                    this.totalPagesNews();
                    this.msgNews(message, 'success');
                    closeModaL.click();
                    resetavatar.src = defaultavatar;
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgNews(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.checkAllNews = () => {
        newsCheckAll.onclick = async(e) => {
            let items = document.getElementsByName('news_chk[]');
            if (newsCheckAll.checked == true){
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

    this.removeNews = () => {
        newsDelForm.onsubmit = (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure you do want to remove this news?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {
                    let response = await fetch(`../index.php?action=dynamicComponent`, {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(newsDelForm)
                    });
            
                    let { message, status } = await response.json();
            
                    if (status == 'success') {
                        this.msgNews(message, 'success');
                        this.fetchNews();   
                        this.totalPagesNews();
                    } else {
                        this.msgNews(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };  
    } 

    this.limitNews = () => {
        limitNews.onchange = async(e) => {
            let val = e.currentTarget.value;
            
            const response = await fetch(`../index.php?action=dynamicComponent&newssort=${val}`, {
                credentials: "same-origin",
                method: "GET",
            });
            let { message, status} = await response.json();

            if(status == 'success') {
                this.tableBodyNews(message);
            } else {
                this.msgNews(message, 'success'); 
            }
        };
    };

    this.totalPagesNews = async() => {
        const response  = await fetch(`../index.php?action=dynamicComponent&totalPageNews`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let output = ``;
            let pagenumber = 1;

            prevNews.onclick = async() => {
                if(pagenumber >= 1) {
                    this.paginationNews(pagenumber -= 1);
                } 

                let btnPrev = document.querySelector(`#btnList${pagenumber +1}`);

                if(btnPrev != undefined) {
                    btnPrev.classList.remove("bg-blue-200");
                }
            };

            nextNews.onclick = async() => {
                if(pagenumber < total_pages) {
                    this.paginationNews(pagenumber += 1);
                }

                let btnNext = document.querySelector(`#btnList${pagenumber}`);

                if(btnNext != undefined) {
                    btnNext.classList.add("bg-blue-200");
                }
            };

            for (let i = 1; i < total_pages+1; i++) {
                output += `<div id="btnList${i}" onclick="(newsObj.paginationNews(${i}))" class="child -bottom-12p-1 mr-2 rounded-md cursor-pointer w-16 h-14 border-solid border-2 flex items-center justify-center border-gray-400 hover:bg-blue-100 font-bold">${i}</div>
                `;
            }

            document.querySelector('#news-btn-pages').innerHTML = output;

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

    this.paginationNews = async(pagenum) => {
        const response = await fetch(`../index.php?action=dynamicComponent&pageNumNews=${pagenum}`, {
            credentials: "same-origin",
            method: "GET",
        });
        let { message, status} = await response.json();

        if(status == 'success') { 
            this.tableBodyNews(message);
        } else {
            this.msgNews(message, 'error'); 
        }
    }

    this.addUpateValueNews = async(news_id) => {

        let formData = new FormData();
        formData.append('newsUpdateValue', news_id);

        let response = await fetch(`../index.php?action=dynamicComponent`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });
        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                document.querySelector('#newsid').value = message.news_id;
                document.querySelector('#title').value = message.title;
                document.querySelector('#summary').value = message.summary;
                document.querySelector('#text').value = message.text;
                document.querySelector('#newpath').value = `${message.newspic}`;
                document.querySelector('#newavatarNews').src = `.${message.newspic}`;
            }
        } else {
            this.msgNews(message, 'error'); 
        }
    }

    this.updateFormNews = () => {

        newcameraNews.onclick = (e) => {
            document.querySelector('#newfileChooserNews').click();
        }
        
        newfileChooserNews.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#newavatarNews').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        newsUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#news-update-btn");
            let resetForm = document.querySelector("#newsUpdateForm");
            let closeModaL = document.querySelector("#newsUpdateModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(newsUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Update";
                    this.fetchNews();
                    this.totalPagesNews();
                    this.msgNews(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgNews(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  

    this.tableBodyNews = (data) => {
        let inc = 0;
        let row = ``;
        let empVal = `<td colspan="7" class="text-center font-extrabold animate-bounce">Data Not Found...</td>`;

        if(data != true) {
            data.forEach(el => {
                let date = new Date(el.create_date).toDateString();
                let time = new Date(el.create_date).toLocaleTimeString();
                row += `
                <tr>
                    <td class="px-5 py-5">
                        <input class="w-5 h-5" type="checkbox" name="news_chk[]" value="${el.news_id}">
                    </td>
                    <td class="px-5 py-5">
                    <div class="card mb-3 w-full">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src=".${el.newspic}" class="img-fluid rounded-start h-full">
                            </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${el.title}</h5>
                                        <p class="card-text">${this.tracateText(el.summary)}</p>
                                        <p class="card-text">${this.tracateText(el.text)}</p>
                                        <p class="card-text"><small class="text-muted">Last updated ${date}- ${time}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5">
                        <button onclick="newsObj.addUpateValueNews(
                            ${el.news_id}
                            )" type="button" data-toggle="modal" data-target="#newsUpdateModal" class="w-16 h-16 hover:border-blue-600 hover:bg-blue-100 hover:text-red-600 tracking-wide text-lg text-white bg-blue-400 py-2 rounded-full border-blue-500 border-2">
                        <i class="fa fa-edit text-2xl"></i>
                        </button> 
                    </td>
                </tr>
                `;
            }); 
        } else {
            row = empVal;
        }
        document.querySelector("#tbodyNews").innerHTML = row;
    };
}

let newsObj = new News();
newsObj.fetchNews();
newsObj.searchNews();
newsObj.addFormNews();
newsObj.checkAllNews();
newsObj.removeNews();
newsObj.limitNews();
newsObj.totalPagesNews();
newsObj.updateFormNews();