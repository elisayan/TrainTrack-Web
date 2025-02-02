async function login(email, password) {
    const url = 'login-controller.php';
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            throw new Error(`Errore di rete: ${response.status}`);
        }

        const json = await response.json();

        if (json["logineseguito"]) {
            console.log("Login riuscito!");
            window.location.href = "home.php";
        } else {
            console.log("Login fallito: " + json["errorelogin"]);
            //document.getElementById("errorMessage").innerText = json["errorelogin"];
        }
    } catch (error) {
        console.log("Errore durante il login: " + error.message);
    }
}

document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    login(email, password);
});