
async function handleLogin(event) {
    event.preventDefault();

    console.log('Logging in...');

    const email = document.getElementById('email_input').value;
    const password = document.getElementById('password_input').value;

    const response = await fetch('/log_in', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    });

    const result = await response.json();

    if (response.ok) {
        console.log(result.message);
    } else {
        console.log(result.error);
    }
}