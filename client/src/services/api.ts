import axios from "axios";
import { UserLoginData } from "../schemas/user-interface";

const axiosInstance = axios.create({
  baseURL: "http://localhost:3000/",
  headers: {
    "Content-Type": "application/json",
  },
});

export const performLogin = async (data: UserLoginData) =>
  (await axiosInstance.post<UserLoginData>("/users/login", data)).data;

export const getData = async () => (await axiosInstance.post("/home")).data;
