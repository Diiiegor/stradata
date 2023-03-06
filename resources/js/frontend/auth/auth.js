export const setLogin = (token) => {
    localStorage.setItem('token', token);
}

export const isLogged = () => {
    const token = getToken()
    return !!token;
}

export const getToken = () => {
    return localStorage.getItem('token');
}

export const logout = () => {
    localStorage.removeItem('token')
}
