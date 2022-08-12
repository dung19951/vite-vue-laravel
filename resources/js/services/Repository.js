import axios from "axios";
let user = JSON.parse(localStorage.getItem("user"));
let config = {};
if (user && user.access_token) {
    config = {
        headers: {
            Authorization: `Bearer ${user.access_token}`,
        },
    };
}
export default axios.create({
    baseURL: window.location.origin + "/api",
    headers:{ Authorization: `Bearer ${user.access_token}`,}
 });
