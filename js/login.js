function generaLoginForm(loginerror = null) {
    let form = `
    <form action="#" method="POST">
        <h3>Login</h3>
        <ul>
            <li>
                <label for="email">Email:</label><input type="text" id="email" name="email" />
            </li>
            <li>
                <label for="password">Password:</label><input type="password" id="password" name="password" />
            </li>
            <li>
                <input type="submit" name="submit" value="Accedi"/>
            </li>
        </ul>
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
