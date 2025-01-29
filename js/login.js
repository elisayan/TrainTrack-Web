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

async function getLoginData() {
    visualizzaLoginForm();
}

const main = document.querySelector("main");
getLoginData();  
