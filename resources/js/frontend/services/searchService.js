import {getToken} from "../auth/auth";

export const search = async (name, percentage, page) => {
    const token = getToken()
    return await fetch('/api/search', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            'Authorization': `bearer ${token}`
        },
        body: JSON.stringify({
            name,
            percentage,
            page,
        })
    }).then(response => response.json());
}
