function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
    <h1>Login</h1>
    <p>Inserisci le tue credenziali per accedere</p>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" name="submit" value="Accedi">
    </form>`;
    return form;
}

async function getLoginData() {
    const url = 'api-login.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        console.log(json);
        if(json["logineseguito"]){
        }
        else{
            visualizzaLoginForm();
        }


    } catch (error) {
        console.log(error.message);
    }
}

const main = document.querySelector("main");
getLoginData();  

function visualizzaLoginForm() {
    // Utente NON loggato
    let form = generaLoginForm();
    main.innerHTML = form;
    // Gestisco tentativo di login
    /*document.querySelector("main form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.querySelector("#username").value;
        const password = document.querySelector("#password").value;
        login(username, password);
    });*/
}
