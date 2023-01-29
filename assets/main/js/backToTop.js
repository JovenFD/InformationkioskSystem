    let btnScrollUp = document.querySelector('#btnScrollUp');
    let header = document.querySelector('#header');

    window.onscroll = () => {
        scroll();
    };

    const scroll = () => {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            btnScrollUp.style.display = "block";
            header.style.backgroundColor = "#9e3131";
        } else {
            btnScrollUp.style.display = "none";
            header.style.backgroundColor = "rgba(255, 255, 255, -8)";
        }
    }

    btnScrollUp.onclick = async(e) => {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }