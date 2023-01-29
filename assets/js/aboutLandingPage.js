function aboutLandingPage() {

    this.msgAbout = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.readMoreBtn = () => {
        missionBtn.onclick = async(e) => {
            let dots = document.querySelector("#dotsMission");
            let moreText = document.querySelector("#moreMission");
    
            if (dots.style.display === "none") {
                dots.style.display = "inline";
                missionBtn.innerHTML = "Read more"; 
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                missionBtn.innerHTML = "Read less"; 
                moreText.style.display = "inline";
            }
        }
    
        vissionBtn.onclick = async(e) => {
            let dots = document.querySelector("#dotsVision");
            let moreText = document.querySelector("#moreVision");
    
            if (dots.style.display === "none") {
                dots.style.display = "inline";
                vissionBtn.innerHTML = "Read more"; 
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                vissionBtn.innerHTML = "Read less"; 
                moreText.style.display = "inline";
            }
        }

        anonymous.onchange = async(e) => {
            let input = document.querySelector("#fullname");
            if (anonymous.checked) {
                input.disabled = true;
                input.value = '';
            } else {
                input.disabled = false;
            }
        }
    }

    this.yearLevelDropDown = async() => {
        let select   = document.querySelector('#yearLevel');
        let defaultop = `<option value="">Select Year Level</option>`
        let output = ``;
        const response = await fetch("./index.php?action=level&view", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    output += `
                        <option value="${el.level_id}">${el.grade_level} - ${el.discription}</option>
                    `;
                });
            } else  {
                    output = `<option value="">Empty Grade Level</option>`;
             } 
            select.innerHTML   = defaultop+output;
        } else {
            this.msgAbout(message, 'error'); 
        }
    }

    this.submitFeedback = () => {
            addFeedbackForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#btnFeedback");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('./index.php?action=feedback', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(addFeedbackForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Submit";
                    this.msgAbout(message, 'success');
                    addFeedbackForm.reset();
                }, 1000);
            } else {
                this.msgAbout(message, 'error');
                btnVal.value = "Field to Submit";
            }
        };
    }
}

let aboutObj = new aboutLandingPage();
aboutObj.readMoreBtn();
aboutObj.yearLevelDropDown();
aboutObj.submitFeedback();