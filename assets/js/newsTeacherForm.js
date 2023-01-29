function DisplayNews() {
    
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

    this.fetchShowNews = async() => {
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

    this.totalPagesLandingNews = async() => {
        const response  = await fetch(`../index.php?action=dynamicComponent&totalPageNews`, {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let total_pages = Math.ceil(message/05);
            let pagenumber = 1;
            let showClickCounter =  document.querySelector('#btnCounter');

            prevLandingPageNews.onclick = async() => {
                if(pagenumber >= 1) {
                    pagenumber -= 1;
                    showClickCounter.innerHTML = pagenumber;
                    this.paginationNews(pagenumber);
                } 
            };

            nextLandingPageNews.onclick = async() => {
                if(pagenumber < total_pages) {
                    pagenumber += 1;
                    showClickCounter.innerHTML = pagenumber;
                    this.paginationNews(pagenumber);
                }
            };

            document.querySelector('#totalCounter').innerHTML = total_pages;
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
                        <td>
                            <div class="card mb-3 w-full">
                            <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="h-full" src=".${el.newspic}" alt="Picture">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                <h5 class="card-title">${el.title}</h5>
                                <p class="card-text text-justify">${el.summary}</p>
                                <p class="card-text text-justify">${el.text}</p>
                                <p class="card-text"><small class="text-muted">Last updated ${date}- ${time}</small></p>
                                </div>
                            </div>
                            </div>  
                        </div>
                        </td>
                    </tr>
                `;
            }); 
        } else {
            row = empVal;
        }
        document.querySelector("#tbodyTeacherNews").innerHTML = row;
    };
}

let showNewsObj = new DisplayNews();
showNewsObj.fetchShowNews();
showNewsObj.totalPagesLandingNews();