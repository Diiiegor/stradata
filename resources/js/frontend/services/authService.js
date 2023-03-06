export const login = async (email, password) => {
    return await fetch('/api/login', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            email,
            password
        })
    }).then(response => response.json());
}
