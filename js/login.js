async function getLoginData() {
    const url = "login-controller.php";

    try {
        const response = await fetch(url);
        if(!response.ok){
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);

        if(json["logineseguito"]){
            console.log("login eseguito");
        }
    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getLoginData();
