import {getToken} from "../auth/auth";

export const fetchLogs = async (page) => {
    const token = getToken()
    return await fetch('/api/logs', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'Authorization': `bearer ${token}`
        },
        body: JSON.stringify({
            page
        })
    }).then(response => response.json());
}
