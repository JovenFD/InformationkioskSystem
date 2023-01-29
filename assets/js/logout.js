async function logout(key) {
    let response = await fetch('../index.php?action=logout-user', {
        method: 'GET',
    });
    let { message, status } = await response.json();

    switch (key) {
        case '0':
            if (status == 'success') {
                window.location = "logout.php";
            } else {
                console.log(message);
            }
        break;
        case '1':
            if (status == 'success') {
                window.location = "../teacher/logout.php";
            } else {
                console.log(message);
            }
        case '2':
            if (status == 'success') {
                window.location = "../guard/logout.php";
            } else {
                console.log(message);
            }
        break
    }
};