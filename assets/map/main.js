// function printMousePos(event) {
//         document.body.textContent =
//             "clientX: " + event.clientX +
//             " - clientY: " + event.clientY;
//         }   

// document.addEventListener("click", printMousePos);


function Maps() {

    this.maximizeCoods = () => {
        $('img[usemap]').rwdImageMaps();
    }
    this.room10 = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 13'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 12'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 11'}
        ];

        return item;
    }

    this.room7 = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 8'}
        ];

        return item;
    }

    this.room5 = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 6'}
        ];

        return item;
    }

    this.room1 = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 2'}
        ];

        return item;
    }

    this.computerLab = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 3'}
        ];

        return item;
    }

    this.facultyRoom = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 4'}
        ];

        return item;
    }
    
    this.firstTwoStoryBuilding = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 28'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 27'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 26'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 25'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 24'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 23'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 22'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 21'}
        ];

        return item;
    }

    this.threeStoryBuilding = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 28'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 27'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 26'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 25'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 24'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 23'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 22'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 21'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 20'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 19'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 18'}, 
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 17'}
        ];

        return item;
    }

    this.secondTwoStoryBuilding = () => {
        let item = [
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 28'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 27'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 26'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 25'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 24'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 23'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 22'},
            {image: './assets/imagemap/IMG_4577.JPG',
            heading: 'Room 21'}
        ];

        return item;
    }

    this.showSceneryBox = async(
        imgSource, 
        heading, 
        description,
        cX,
        cY
        ) => {

            let d = document.querySelector("#display");
            let e = document.querySelector("#conatiner");
            e.style.overflow = "hidden";
            document.addEventListener('click', this.displayFollowCamera(cX, cY));
            d.style.left = cX + 1 + "px";
            d.style.top  = cY + 1 + "px";
            d.innerHTML  = "<div id='wrapper'><img id='imgzm' class='h-full w-4/5' src='" + imgSource + "'>" + "<p>" + heading + "</p>" + "<p>" + description + "</p><i class=' animate-pulse fas fa-map-marker-alt text-3xl delay-100 text-red-700 relative mt-3'></i></div>";
        
            let output = '';
        
            switch (heading) {
                case 'Room 10':
                    this.room10().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;
                case 'Room 7':
                    this.room7().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;
                case 'Room 5':
                    this.room5().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;
                case 'Room 1':
                    this.room1().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    
                    this.popover(output);
                break;

                case 'COMPUTER LAB':
                    this.computerLab().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;

                case 'FACULTY ROOM':
                    this.facultyRoom().forEach(el => {

                        output += `
                            <div class="col">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;

                case 'SECOND TWO STORY BUILDING':
                    this.secondTwoStoryBuilding().forEach(el => {

                        output += `
                            <div class="col-sm-3">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;

                case 'FIRST TWO STORY BUILDING':
                    this.secondTwoStoryBuilding().forEach(el => {

                        output += `
                            <div class="col-sm-3">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    this.popover(output);
                break;

                case 'THREE STORY BUILDING':
                    this.threeStoryBuilding().forEach(el => {

                        output += `
                            <div class="col-sm-3">
                                <img class="h-4/5 w-full rounded border-2 border-gray-500" src="${el.image}" /><p>${el.heading}</p>
                            </div>
                        `;
                        
                    });
                    
                    this.popover(output);
                break;
            }
        }

    this.popover = (output) => {
        $('#imgzm').popover({
            placement: 'top',
            html: true,
            trigger: 'hover',
            content: function () {
                return `
                    <div class="row">
                        ${output}
                    </div>
                `;
            }
        });
    }

    this.displayFollowCamera = (cX, cY) => {
        let a = document.querySelector('#display');
        a.style.left = cX + 1 + "px";
        a.style.top  = cY + 1 + "px";
    }

    this.removeSceneryBox = () => {
        let a = document.querySelector("#display");
        let b = document.querySelector("#conatiner");
        a.removeAttribute('style');
        b.removeAttribute('style');
        this.displayFollowCamera();
        a.removeChild(a.childNodes[0]);
    }
}

let mapObj = new Maps();
mapObj.maximizeCoods();