import axios from "axios";
import { Msg } from "../interfaces/msg";

const axiosInstance = axios.create({
  baseURL: "http://localhost:3000/",
});

export async function getMsg() {
  return (await axiosInstance.get<Msg>("/")).data;
}
