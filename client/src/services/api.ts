import axios from "axios";

export const axiosInstance = axios.create({
  baseURL: "http://localhost:3000/",
  headers: {
    "Content-Type": "application/json",
  },
});

export function getToken() {
  return localStorage.getItem("auth_token");
}

export function invalidateToken() {
  localStorage.removeItem("auth_token");
}
